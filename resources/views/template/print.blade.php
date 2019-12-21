<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
    @yield('css')
</head>
<body>
<header style="text-align: center;margin: 0">
    <h2 style="margin: 0">{{ Config::get('app.company.name') }}</h2>
    <p class="text-muted m-l-5" style="margin: 0">
        {{ Config::get('app.address.house') }} , {{ Config::get('app.address.road') }} , {{ Config::get('app.address.sector') }}
        <br>
        {{ Config::get('app.address.area') }} , {{ Config::get('app.address.city') }} - {{ Config::get('app.address.post') }}
    </p>
</header>
    @yield('content')

    @yield('footer-scripts')
</body>
</html>
