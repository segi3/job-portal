    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- page title --}}
    <title>@yield('title')</title>

    {{-- <!-- <link rel="manifest" href="site.webmanifest"> --> --}}

    {{-- <link rel="shortcut icon" href="{{ asset('portal_resources') }}/img/favicon.png"> --}}
    <link rel="icon" href="favicon.png">
    {{-- <!-- Place favicon.ico in the root directory --> --}}

    {{-- <!-- CSS here --> --}}
    <link rel="stylesheet" href="{{ asset('portal_resources') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('portal_resources') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('portal_resources') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('portal_resources') }}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('portal_resources') }}/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('portal_resources') }}/css/nice-select.css">
    <link rel="stylesheet" href="{{ asset('portal_resources') }}/css/flaticon.css">
    <link rel="stylesheet" href="{{ asset('portal_resources') }}/css/gijgo.css">
    <link rel="stylesheet" href="{{ asset('portal_resources') }}/css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('portal_resources') }}/css/slicknav.css">

    <link rel="stylesheet" href="{{ asset('portal_resources') }}/css/style.css">
    {{-- <!-- <link rel="stylesheet" href="css/responsive.css"> --> --}}

    {{-- css portal --}}
    <link rel="stylesheet" href="{{ asset('portal_resources') }}/css/portal.css">

    {{-- own's page scripts/stylesheets --}}
    @yield('stylesheets')