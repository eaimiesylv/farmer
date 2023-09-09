<html lang="<?php  app()->getLocale(); ?>">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
   
    <link rel="shortcut icon" href="{{ config('settings.application.company_icon') }}" />
    <link rel="apple-touch-icon" href="{{ config('settings.application.company_icon') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ config('settings.application.company_icon') }}" />
    <title>{{ __t('install') }} - {{ config('app.name') }}</title>
    @include('layouts.includes.header')
    
   <!-- <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="5c9b5876-1440-4776-8bdb-fc5700adc238";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>-->
<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>

</head>
<body>
    <!--<div class="elfsight-app-b6392f26-2399-4bbf-b3a9-081369edbd67"></div>-->
<div id="app">
    <div class="container">
        @yield('contents')
    </div>
</div>
<script>
    window.localStorage.setItem('app-languages',
        JSON.stringify(
            <?php echo json_encode(include resource_path().DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.(app()->getLocale() ?? 'en').DIRECTORY_SEPARATOR.'default.php')?>
        )
    );
    window.localStorage.setItem('base_url', '<?php echo request()->root(); ?>');
</script>

<script>
    window.localStorage.setItem('app-language', '<?php echo app()->getLocale() ?? "en"; ?>');
    window.appLanguage = window.localStorage.getItem('app-language');
</script>
@include('layouts.includes.footer')
</body>
</html>
