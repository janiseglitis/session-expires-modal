<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

<div class="drawer">
    <input id="app-drawer" type="checkbox" class="drawer-toggle"/>
    <div class="drawer-content">

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

    <div class="drawer-side">
        <label for="app-drawer" class="drawer-overlay"></label>

        <ul class="menu p-4 w-80 bg-base-100 text-base-content">
            <li><a href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Log Out') }}</a>
            </li>
            <li class="mt-10 text-sm">
                {{ __('Session time') }}: {{ config('session.lifetime') }}min
            </li>
        </ul>
    </div>
</div>

@include('expiration_modal')

<form method="POST" action="{{ route('logout') }}" id="logout-form" class="hidden">
    @csrf
    <input type="hidden" name="show_expiration_message" id="show-expiration-message" value="0">
</form>

@stack('scripts')

</body>
</html>
