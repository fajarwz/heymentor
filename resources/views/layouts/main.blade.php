<!doctype html>
<html>

<head>
    @include('partials.head')
    @vite(['resources/css/app.css'])
</head>

<body>
    @include('partials.nav')
    @yield('content')
    @yield('after-scripts')
</body>

</html>