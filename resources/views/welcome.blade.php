<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'MyCanvas') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}" >
        <script src="{{ asset('js/menu.js')}}"></script>
    </head>
    <body class="home">
        <?php
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        #echo session_id();
        }
        ?>
        @include('layouts.navigation_guest')
        <header class="header bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Welcome') }}
                </h2>
                <a class="btn" href="{{ URL('/login') }}">+</a>
            <form class="filter" action="{{ route('reorder_welcome')  }}" method="post">
                @csrf
                <label for="filter">Sort by</label>
                <select name="filter" id="filter" onchange="this.form.submit()">
                    @if(isset($filter))
                    <option disabled selected value>{{$filter}}</option>
                    @else
                    <option disabled selected value>recently added</option>
                    @endif
                    <option value="price">price</option>
                    <option value="artist">artist</option>
                    <option value="title">title</option>
                </select>
            </form>
            </div>
        </header>
        @if(session()->has('message'))
        <div class="message">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="gallery">
                        @foreach($images as $img)
                        <x-image :img=$img :liked=$liked>
                            <x-guest-menu :img=$img :liked=$liked>></x-guest-menu>
                        </x-image>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
