<!doctype html>
<html>

<head>
    @include('partials.head')
    @vite(['resources/css/app.css'])
</head>

<body>
    @include('partials.nav')
    @yield('content')
    @include('partials.scripts')
    @yield('after-scripts')
</body>

</html>