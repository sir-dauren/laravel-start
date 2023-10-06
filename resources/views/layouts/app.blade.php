<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', config('app.name'))</title>
        @vite('resources/js/app.js')
    </head>
    <body class="antialiased">
        @if (session('message'))
            <div class="bg-green-600 text-white p-5 text-center">
                <h4>{{ session('message') }}</h4>
            </div>
        @endif

        @auth

            {{ auth()->user()->email }}

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit">Выход</button>
            </form>
            
        @elseguest
            <a href="{{ route('login') }}">Войти</a>
        @endauth


        @yield('content');
    </body>
</html>
