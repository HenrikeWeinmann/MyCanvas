@include('layouts.navigation')
<x-app-layout>
    <x-slot name="header">
        <div class="header-left">
            <a class="return" href="{{route('return') }}">
                <img class="icon return"src="/icons/back.svg" alt="My SVG Icon"></button>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Details') }}
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
                    <div class="guest-details">
                    <img class="details-img" src="/images/{{$img->image_path}}" title="{{$img->title}}"onclick="menu({{$img->id}})">
                        <div class="details-content">
                            <span>Title: {{$img->title}}</span><br>
                            <span>Artist: {{$img->artist}}</span><br>
                            <span>Description:{{$img->description}}</span><br>
                            <span>Price:{{$img->price}}</span>
                            <div class="inline-flex mt-8">
                            <span>Seller:{{$seller->name}}
                            @if($seller->id != auth()->user()->id)
                            @if(auth()->user()->follower->where('followed_user_id',$seller->id)->count() == 0)
                                <form class="follow" action="{{route('follow')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="follow_id" value="{{$seller->id}}">
                                    <button type="submit" name="button">follow</button>
                                </form>
                            @else
                                <form class="unfollow" action="{{route('unfollow')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="name" value="{{$seller->name}}">
                                    <button type="submit" name="button">unfollow</button>
                                </form>
                            @endif
                            @endif
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
