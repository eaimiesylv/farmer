<html>
<body style="background-color:#EDF2F7; overflow:scroll">
    <div style="text-align:center;display:flex;width:350px;margin:0 auto;padding-top:2em;padding-bottom:1em;">
        <h2 style="margin-top:1.3em;margin-right:10px"><img src="https://connect.fnsdealroom.com/images/log.png" width="70px"  height="35px" alt="Excapture"></h2>
        <h2 style="text-align:center;color:black;font-size:2.2em;">Fnsdealroom</h2>
    </div>
    <div style="background-color:#fff;width:70%;margin:0 auto;padding:2em;color:black;text-align:center">
        @if (session('success'))
            <p style="font-size:1.2em;">Your account has been successfully verified.</p>
        @elseif (session('error'))
            <p style="font-size:1.2em;color:red;">{{ session('error') }}</p>
        @else
            <p style="font-size:1.2em;color:red;">Email not found</p>
        @endif
        <button style="text-align:center;padding:1em;background-color:blue;color:white;margin:2em auto;display:block;border:none;border-radius:0.2em">
            <a href="https://connect.fnsdealroom.com/admin/users/login" style="text-decoration:none;color:white">Back to login</a>
        </button>
    </div>
    <p style="font-size: 12px; text-align: center; margin:2em; padding-bottom: 2em;">
        &copy; {{ date('Y') }} {{ config('app.name') }} 
    </p>
</body>
</html>
