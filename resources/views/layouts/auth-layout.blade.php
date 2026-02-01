<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('build/css/bootstrap.min.css') }}">
</head>

<body>

@yield('content')

</body>
</html>
