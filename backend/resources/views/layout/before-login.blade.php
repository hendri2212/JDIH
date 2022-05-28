<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="antialiased">
        <div class="wrapper">
            <!-- Login Page Start -->
            <div class="m-account-w">
                <div class="m-account">
                    @includeWhen($is_login, 'auth.login')
                    @includeWhen(!$is_login, 'auth.register')
                </div>
            </div>
            <!-- Login Page End -->
        </div>
        <!-- Wrapper End -->

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
