@include('layouts.navigation')
<x-app-layout>
    <x-slot name="header">
        <div class="header-left">
            <a class="return" href="{{route('return') }}">
                <img class="icon return"src="/icons/back.svg" alt="My SVG Icon"></button>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Checkout') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 ">
                    <div class="checkout-container">
                        <h4 class="shipping">Shipping Details:</h4>
                    <form  class="shipping" id="shipping" method="post" action="{{route('order')}}" >
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
                    <button type="button" class="btn btn-primary btn-order" onclick="submitForm('shipping')">Confirm Order</button>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
