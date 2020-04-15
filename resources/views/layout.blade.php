<!DOCTYPE html>

<html class="no-js" lang="zxx">

<head>

    {{-- html head --}}
    @include('partials._head')

</head>

<body>
    
    {{-- body head --}}
    @include('headers._header')

    {{-- content --}}
    @yield('content')

    {{-- footer --}}
    @include('footers._footer')

    {{-- portal's js's --}}
    @include('partials._javascripts')

    {{-- own's page js's --}}
    @yield('scripts')

</body>

</html>