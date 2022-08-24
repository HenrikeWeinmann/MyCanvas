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
                    {{ __('Checkout') }}
                </h2>
            </div>
        </header>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="checkout-container">
                        <h4 class="shipping">Shipping Details:</h4>
                    <form  class="shipping"method="post" action="{{route('guest_order')}}" >
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="string" id="name" name="name" class="@error('name') is-invalid @enderror form-control">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1 error">{{ $message }}</div>
                        @enderror
                        <label for="firstname">Firstname</label>
                        <input type="string" id="firstname" name="firstname" class="@error('firstname') is-invalid @enderror form-control">
                        @error('firstname')
                        <div class="alert alert-danger mt-1 mb-1 error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input type="string" id="street" name="street" class="@error('street') is-invalid @enderror form-control">
                        @error('street')
                        <div class="alert alert-danger mt-1 mb-1 error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="string" id="city" name="city" class="@error('city') is-invalid @enderror form-control">
                        @error('city')
                        <div class="alert alert-danger mt-1 mb-1 error">{{ $message }}</div>
                        @enderror
                        <label for="zip">Postal/ Zip Code</label>
                        <input type="integer" id="zip" name="zip" class="@error('zip') is-invalid @enderror form-control">
                        @error('zip')
                        <div class="alert alert-danger mt-1 mb-1 error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="string" id="country" name="country" class="@error('country') is-invalid @enderror form-control">
                        @error('country')
                        <div class="alert alert-danger mt-1 mb-1 error">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-order">Confirm Order</button>
                    </form>
                    <div class="orderSummary">
                    <h4 class="orderSummary">Order Summary:</h4>
                    <div class="overflow-x-auto p-3">
                        <table class="table-auto w-full orderSummary">
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
        </div>
    </div>
</body>
</html>
