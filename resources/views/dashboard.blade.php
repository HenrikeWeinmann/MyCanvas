@include('layouts.navigation')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <a class="btn" href="{{ URL('/upload') }}">+</a>
        <form class="filter" action="{{ route('reorder')  }}" method="post">
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
                    @foreach($images as $img)
                    <x-image :img=$img :liked=$liked>
                        <x-menu :img=$img :liked=$liked>></x-menu>
                        @if(isset($filter))
                        <div class="filter-info">
                            {{$img->$filter}}
                        </div>
                        @endif
                    </x-image>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
