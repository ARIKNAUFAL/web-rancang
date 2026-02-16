
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guidance | {{ $title }}</title>
    <link rel="icon" href="{{ asset('templateAdmin/dist/image/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('templateAdmin/dist/css/login-admin.css') }}">
    <link rel="stylesheet" href="{{ asset('templateAdmin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templateAdmin/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templateAdmin/bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templateAdmin/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('templateAdmin/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templateAdmin/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <body>
    @yield('contentAuth')


    <script src="{{ asset('templateAdmin/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('templateAdmin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('templateAdmin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('templateAdmin/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('templateAdmin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('templateAdmin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('templateAdmin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('templateAdmin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('templateAdmin/dist/js/pages/dashboard2.js') }}"></script>
    <script src="{{ asset('templateAdmin/dist/js/demo.js') }}"></script>
  </body>
</html>
