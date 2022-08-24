@include('layouts.navigation')
<x-app-layout>
    <x-slot name="header">
        <div class="header-left">
            <a class="return" href="{{route('return') }}">
                <img class="icon return"src="/icons/back.svg" alt="My SVG Icon"></button>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 modify">
                    <div class="image">
                        <img class="img" id="img" src="/images/{{$img->image_path}}" title="{{$img->title}}"onclick="menu({{$img->id}})">
                        <figcaption class="subtitle">{{$img->title}}</figcaption>
                    </div>
                    <form name="modify" id="modify" method="post" action="{{route('update_image')}}">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="string" id="title" name="title" value="{{$img->title}}" class="@error('title') is-invalid @enderror form-control">
                        @error('title')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="artist">Artist</label>
                        <input type="string" id="artist" name="artist" value="{{$img->artist}}" class="@error('artist') is-invalid @enderror form-control">
                        @error('artist')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" value="{{$img->description}}"class="@error('description') is-invalid @enderror form-control">
                        @error('description')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="decimal" id="price" name="price"value="{{$img->price}}" pattern="[0-9]+([\.,][0-9]+)?" step="0.01"class="@error('price') is-invalid @enderror form-control">
                        @error('price')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="sold">Sold</label>
                        <input type="checkbox" id="sold" name="sold" class="@error('sold') is-invalid @enderror form-control checkbox">
                        @error('sold')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="unique">Unique artwork</label>
                        <input type="checkbox" id="unique" name="unique" class="@error('unique') is-invalid @enderror form-control checkbox">
                        @error('unique')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="img_id" value="{{$img->id}}">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
