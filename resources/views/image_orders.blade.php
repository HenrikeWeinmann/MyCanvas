@include('layouts.navigation')
<x-app-layout>
    <x-slot name="header">
        <div class="header-left">
            <a class="return" href="{{route('return') }}">
                <img class="icon return"src="/icons/back.svg" alt="My SVG Icon"></button>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Orders') }}
            </h2>
        </div>
    </x-slot>
    @if(session()->has('message'))
    <div class="message">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <img class="img" id="img" src="/images/{{$img->image_path}}" title="{{$img->title}}"onclick="menu({{$img->id}})">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                            <tr>
                                <th class="p-2">
                                    <div class="font-semibold text-left">Quantity</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-left">Name</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-left">Address</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-center">Total</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-center">Date</div>
                                </th>
                                <th class="p-2">
                                    <div class="font-semibold text-left">Shippment Status</div>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="text-sm divide-y divide-gray-100">
                            <!-- items  -->
                            @foreach($orders as $order)
                            <tr>
                                <td class="p-2">
                                    <div class="font-medium text-gray-800">
                                        {{$order->qty}}
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class="text-left">
                                        {{$order->name}},{{$order->firstname}}
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class="text-left">
                                        {{$order->street}},
                                        {{$order->city}},
                                        {{$order->zip}},
                                        {{$order->country}}
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class="text-left font-medium text-green-500">
                                        {{$order->qty * $order->price}}
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class="flex justify-center">
                                        {{$order->created_at}}
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class="flex justify-center">
                                        <p>not yet shipped</p>
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
</x-app-layout>
