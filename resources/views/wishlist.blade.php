@include('layouts.navigation')
<x-app-layout>
    <x-slot name="header">
        <div class="header-left header">
            <a class="return" href="{{route('return') }}">
                <img class="icon return"src="/icons/back.svg" alt="My SVG Icon"></button>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Favourites') }}
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
                    @foreach($images as $img)
                    <x-image :img=$img :liked=$liked><x-menu :img=$img :liked=$liked></x-menu>
                    </x-image>
                    @endforeach
                     </div>
                     <div class="other-lists">


                    <h2 class="font-semibold text-xl text-gray-800 leading-tight block">
                        {{ __('Other Lists') }}
                    </h2>
                    @foreach($followed as $name => $board)
                    <div class="inline-flex gap-1.5">
                    {{$name}}
                    <form class="unfollow" action="{{route('unfollow')}}" method="post">
                        @csrf
                        <input type="hidden" name="name" value="{{$name}}">
                        <button type="submit" name="button">unfollow</button>
                    </form>
                    </div>
                    @foreach($board as $key => $img)
                    <div class="gallery">
                    <x-image :img=$img :liked=$liked></x-image>
                     </div>
                    @endforeach
                    @endforeach
                    {{ __('Follow more creators') }}
                    <form class="" action="{{route('search')}}" method="post">
                        @csrf
                        <input class="search" type="search" name="search" placeholder="enter name"value="">
                        <button class="btn search" type="submit" name="button">search</button>
                    </form>
                    @if(session()->has('search','found','all_images'))
                    <div class="table">
                        <?php
                        $users = session('search');
                        $found = session('found');
                        $all_images = session('all_images');
                         ?>
                         @if(!$found)
                         <div class="not-found">
                             <p>We coud not find the user! You might want to follow these users instead...</p>
                         </div>
                         @endif
                         <table>
                             <tr><th>User</th>
                                 <th>Latest Post</th>
                             </tr>
                         @foreach($users as $user)
                         <tr>
                             <td> {{ $user->name}}</td>
                             <td><img class="img latest-img" src="images/{{ $all_images->get($user->id)}}" alt="latest post"></td>
                             <td>
                                 @if(auth()->user()->follower->where('followed_user_id',$user->id)->count() == 0)
                                     <form class="follow" action="{{route('follow')}}" method="post">
                                         @csrf
                                         <input type="hidden" name="follow_id" value="{{$user->id}}">
                                         <button type="submit" name="button">follow</button>
                                     </form>
                                 @else
                                     <form class="unfollow" action="{{route('unfollow')}}" method="post">
                                         @csrf
                                         <input type="hidden" name="name" value="{{$user->name}}">
                                         <button type="submit" name="button">unfollow</button>
                                     </form>
                                 @endif
                            </td>
                            </tr>
                         @endforeach
                         </table>
                        </div>
                        @endif
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
