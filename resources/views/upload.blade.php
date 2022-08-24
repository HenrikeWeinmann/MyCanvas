@include('layouts.navigation')
<x-app-layout>
    <x-slot name="header">
        <div class="header-left">
            <a class="return" href="{{route('return') }}">
                <img class="icon return"src="/icons/back.svg" alt="My SVG Icon"></button>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Upload') }}
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
                    Here you can add a post:
                    <form name="upload" id="images" method="post" action="{{url('store-image')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="string" id="title" name="title" class="@error('title') is-invalid @enderror form-control">
                        @error('title')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="artist">Artist</label>
                        <input type="string" id="artist" name="artist" class="@error('artist') is-invalid @enderror form-control">
                        @error('artist')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" class="@error('description') is-invalid @enderror form-control">
                        @error('description')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image_upload" name="image" class="@error('image') is-invalid @enderror form-control">
                        @error('image')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="decimal" id="price" name="price" pattern="[0-9]+([\.,][0-9]+)?" step="0.01"class="@error('price') is-invalid @enderror form-control">
                        @error('price')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="sold">Sold</label>
                        <input type="checkbox" id="sold" name="sold"  class="@error('sold') is-invalid @enderror form-control">
                        @error('sold')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="unique">Unique artwork</label>
                        <input type="checkbox" id="unique" name="unique"  class="@error('unique') is-invalid @enderror form-control">
                        @error('unique')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
