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
        }
        ?>
        @include('layouts.navigation_guest')
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Thank you for your Order!') }}
                </h2>
            </div>
        </header>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Order Summary:
                    <div class="overflow-x-auto p-3">
                        <table class="table-auto w-full">
                            <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                <tr>
                                    <th class="p-2">
                                        <div class="font-semibold text-left">Piece</div>
                                    </th>
                                    <th class="p-2">
                                        <div class="font-semibold text-left">Title</div>
                                    </th>
                                    <th class="p-2">
                                        <div class="font-semibold text-left">Quantity</div>
                                    </th>
                                    <th class="p-2">
                                        <div class="font-semibold text-left">Total</div>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="text-sm divide-y divide-gray-100">
                                <!-- items  -->
                                @foreach($items as $item)
                                <tr>
                                    <td class="p-2">
                                        <div class="font-medium text-gray-800">
                                            <img class="img cart_item" id="img" src="/images/{{$item->image_path}}" title="{{$item->title}}">
                                        </div>
                                    </td>
                                    <td class="p-2">
                                        <div class="text-left">
                                            {{$item->title}}
                                        </div>
                                    </td>
                                    <td class="p-2">
                                        <div class="text-left">
                                            {{$item->qty}}
                                        </div>
                                    </td>
                                    <td class="p-2">
                                        <div class="text-left font-medium text-green-500">
                                            {{$item->price}}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
