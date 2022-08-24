@include('layouts.navigation')
<x-app-layout>
    <x-slot name="header">
        <div class="header-left">
            <a class="return" href="{{route('return') }}">
                <img class="icon return"src="/icons/back.svg" alt="My SVG Icon"></button>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Cart') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Table -->
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
                                        <div class="font-semibold text-left">Type</div>
                                    </th>
                                    <th class="p-2">
                                        <div class="font-semibold text-left">Total</div>
                                    </th>
                                    <th class="p-2">
                                        <div class="font-semibold text-center">Remove</div>
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
                                            @if(!$item->unique)
                                            <form id="qty-form" action="{{ route('edit_qty')  }}" method="post">
                                                @csrf
                                                <input type="hidden" id="img_id" name="img_id" value="{{$item->image_id}}">
                                                <input type="number" id="qty" name="qty" value="{{$item->qty}}" onfocusout="submitForm('qty-form')">
                                            </form>
                                            @else
                                                {{$item->qty}}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-2">
                                        <div class="text-left">
                                            @if($item->unique)
                                                unique artwork
                                            @else
                                                print
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-2">
                                        <div class="text-left font-medium text-green-500">
                                            {{$item->price}}€
                                        </div>
                                    </td>
                                    <td class="p-2">
                                        <div class="flex justify-center">
                                            <form class="" action="{{ route('remove')  }}" method="post">
                                                @csrf
                                                 <input type="hidden" id="item_id" name="item_id" value="{{$item->id}}">
                                                <button type="submit" name="remove" >
                                                    <svg class="w-8 h-8 hover:text-blue-600 rounded-full hover:bg-gray-100 p-1"fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- total amount -->
                    <div class="flex justify-end font-bold space-x-4 text-2xl border-t border-gray-100 px-5 py-4">
                        <div>Total</div>
                        <div class="text-blue-600">{{$total}}<span id="total"> €</span>
                        </div>
                    </div>
                    <div class="cart-bottom">

                        <a class="btn continue-to-shop" href="{{route('dashboard')}}">
                            <img class="icon return"src="/icons/back.svg" alt="My SVG Icon">
                            Continue to shop </a>
            @if(count($items) > 0)
            <form class="btn continue" action="{{URL('/checkout')}}" method="post">
                @csrf
                <button type="submit" name="checkout" >
                    Checkout
                    <img src="/icons/continue.svg" alt="My SVG Icon"></button>
            </form>
            @endif
            </div>
            </div>
        </div>
        </div>
    </div>
</x-app-layout>
