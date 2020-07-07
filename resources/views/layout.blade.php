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
    @if(Route::current()->getName() == 'login-welcome')
    
    @else
        @include('footers._footer')
    @endif
    

    {{-- portal's js's --}}
    @include('partials._javascripts')

    {{-- own's page js's --}}
    @yield('scripts')

</body>

</html>