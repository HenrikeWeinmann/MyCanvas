@include('layouts.navigation')
<x-app-layout>
    <x-slot name="header">
        <div class="header-left">
            <a class="return" href="{{route('return') }}">
                <img class="icon return"src="/icons/back.svg" alt="My SVG Icon"></button>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Profile') }}
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
                    <div class="gallery">
                        <h2>Your Posts:</h2>
                        @foreach($images as $img)
                            <div class="">
                            <div class="image">
                                <p class="sold-banner sold{{$img->sold}}">sold sold sold</p>
                                <img class="img sold{{$img->sold}}" src="/images/{{$img->image_path}}" title="{{$img->title}}">
                                <figcaption class="subtitle"> {{$img->title}}</figcaption>
                                </div>
                                @if( $img->sold =="1")
                                <form id="orders" class="profile-options" action="{{ route('show_orders')  }}" method="post">
                                    @csrf
                                     <input type="hidden" id="img_id" name="img_id" value="{{$img->id}}">
                                    <button type="submit" name="delete" >show orders</button>
                                </form>
                                @else
                                <div class="profile-options">
                                <form id="delete" action="{{ route('delete')  }}" method="post">
                                    @csrf
                                     <input type="hidden" id="img_id" name="img_id" value="{{$img->id}}">
                                    <button type="button" name="delete" onclick="confirmDelete()">
                                        <svg class="w-8 h-8 hover:text-blue-600 rounded-full hover:bg-gray-100 p-1"fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                        </svg>
                                    </button>
                                </form>
                                <form id="edit" action="{{ route('edit')  }}" method="post">
                                    @csrf
                                     <input type="hidden" id="img_id" name="img_id" value="{{$img->id}}">
                                    <button type="submit" name="edit">edit</button>
                                </form>
                                </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
