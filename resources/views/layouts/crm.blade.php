<html lang="<?php  app()->getLocale(); ?>">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="shortcut icon" href="{{ env('APP_URL').config('settings.application.company_icon') }}"/>
    <link rel="apple-touch-icon" href="{{ env('APP_URL').config('settings.application.company_icon') }}"/>
    <link rel="apple-touch-icon-precomposed" href="{{ env('APP_URL').config('settings.application.company_icon') }}"/>

    <title>@yield('title') - {{ config('app.name') }}</title>
    @include('layouts.includes.header')
   <!-- <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="5c9b5876-1440-4776-8bdb-fc5700adc238";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>-->
   <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>

</head>
<body>
	<div class="elfsight-app-074de0bd-de09-450a-997a-ac3fa64fb8b0"></div>
    <!--<div class="elfsight-app-b6392f26-2399-4bbf-b3a9-081369edbd67"></div>-->
<div id="app">
    <div class="container-scroller">
	
        <!--Top Navbar-->
    @section('nav-bar')
        @include('layouts.includes.navbar')
    @show
    <!--Sidebar-->
        @section('side-bar')
            <!--Vue route
                <div  id="app"  class="col-md-12">
                          
                            <app-nav-navbar></app-nav-navbar>
                </div> -->
                
            @include('layouts.includes.sidebar')
                   
        @show
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <!--<router-view></router-view>
                Contents-->
                 @yield('contents')
            </div>
        </div>
    </div>
</div>
@guest()
    <script>
        window.localStorage.removeItem('permissions');
    </script>
@endguest

@auth()
    <script>
        window.localStorage.setItem('permissions', JSON.stringify(
            <?php echo json_encode(array_merge(
                    resolve(\App\Repositories\Core\Auth\UserRepository::class)->getPermissionsForFrontEnd(),
                    [
                        'is_app_admin' => auth()->user()->isAppAdmin(),
                    ]
                )
            )
            ?>
        ))
        window.onload = function () {
            window.scroll({
                top: 0,
                left: 0,
                behavior: 'smooth'
            })
        }
    </script>
@endauth

<script>

    window.localStorage.setItem('base_url', '<?php echo request()->root(); ?>');
</script>

<script>
    window.settings = <?php echo json_encode($settings) ?>
</script>
<script>
    if (!window.localStorage.getItem('app-language')) {
        // initital language added
        window.localStorage.setItem('app-language', "en");
    }
    ;

    window.user = <?php echo auth()->user()->load('profilePicture', 'roles'); ?>;
    window.user.isAppAdmin = "{{!!auth()->user()->isAppAdmin()}}";
    window.broadcastDriver = "{{config('services.broadcast_custom_driver','ajax')}}";
    window.pusherDriver = <?php echo config('services.broadcast_custom_driver') == 'pusher' ?  json_encode([
				'MIX_PUSHER_APP_KEY'=>config('broadcasting.connections.pusher.key'),
				'MIX_PUSHER_APP_CLUSTER'=>config('broadcasting.connections.pusher.options.cluster')
			]) : json_encode([
				'MIX_PUSHER_APP_KEY'=>'',
				'MIX_PUSHER_APP_CLUSTER'=>''
			]) ?>
</script>
<script>
    window.localStorage.setItem('app-languages',
        JSON.stringify(
            @php
                echo
                    json_encode(
                        include resource_path()
                            . DIRECTORY_SEPARATOR . 'lang'
                            . DIRECTORY_SEPARATOR .
                            (
                                Cookie::has('user_lang') ? Cookie::get('user_lang') : ($settings['language'] ?? 'en')
                            )
                            . DIRECTORY_SEPARATOR . 'default.php'
                    )
            @endphp
        )
        );
</script>
@include('layouts.includes.footer')
</body>
</html>
