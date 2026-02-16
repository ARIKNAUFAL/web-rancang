<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DigiLearn')</title>
    <!--** Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Permanent+Marker&display=swap"
        rel="stylesheet">
    <!--** Reset default CSS style -->
    <link rel="stylesheet" href="{{ asset('templateFrontend/vendors/normalize.css') }}">
    <!--** CSS properties -->
    <link rel="stylesheet" href="{{ asset('templateFrontend/resources/css/variables.css') }}">
    <!--** Swiper JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <!--** External CSS -->
    @yield('css')
</head>

<body>
    <header>
        <h1>@yield('title', 'DigiLearn')</h1>
    </header>
    @yield('content')
    <script defer src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script defer src="{{ asset('templateFrontend/vendors/JavaScript/swiper.js') }}"></script>
    @yield('script')
</body>

</html>
