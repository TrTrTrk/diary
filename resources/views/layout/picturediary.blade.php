<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href={{asset("/css/normalize.css")}}>
    <link rel="stylesheet" href={{asset("/css/style.css")}}>
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho" rel="stylesheet">
    <script src="" charset="utf-8"></script>
</head>

<body>
    <header class="clearfix">
        <h1><a class="link" href="/">picture diary</a></h1>
        @yield('header')
    </header>
    <main>
        @yield('main')
    </main>
    <footer>
        <small>Copyright &copy; 2023 picture diary, All Rights Reserved.</small>
        {{-- @yield('footer') --}}
    </footer>
</body>

</html>