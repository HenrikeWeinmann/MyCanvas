<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Wishlist;
use Auth;

class HomeController extends Controller
{
    public function index(){
        $images = DB::table('images')->get();
        $liked = collect();
        return view('welcome', compact('images','liked'));
    }

    public function show_wishlist(){
        $wishlist = DB::table('wishlist')->where('user_id',Auth::user()->id)->pluck('image_id');
        $images = DB::table('images')->whereIn('id', $wishlist)->get();
        $liked = DB::table('wishlist')->where('user_id',Auth::user()->id)->pluck('image_id');
        $followed_users = DB::table('followers')->where('user_id',Auth::user()->id)->pluck('followed_user_id');
        $followed = collect();
        foreach ($followed_users as $user ) {
            $followed_wishlist =DB::table('wishlist')->where('user_id',$user)->pluck('image_id');
            $name =  DB::table('users')->where('id',$user)->first()->name;
            $board =DB::table('images')->whereIn('id',$followed_wishlist)->get();
            $followed->put($name,$board);
        }
        #dd($followed);
        return view('wishlist', compact('images','liked','followed'));
    }

    public function like(Request $request){
        $validatedData = $request->validate([
          'img_id' => 'required',
        ]);
        $img = $request->img_id;
        $wishlist = DB::table('wishlist')->where('user_id',Auth::user()->id)->pluck('image_id');
        #dd($wishlist);
        if ($wishlist->contains($img)) {
            DB::table('wishlist')->where('user_id',Auth::user()->id)->where('image_id', $img)->delete();
        }
        else {
            $wishlist = new Wishlist();
            $wishlist->image_id = $request->img_id;
            $wishlist->user_id = Auth::user()->id;
            $wishlist->save();
        }
        return redirect()->back();
    }

    public function guest_show_details(Request $request){
        $validatedData = $request->validate([
          'img_id' => 'required',
        ]);
        $img = DB::table('images')->where('id',$request->img_id)->first();
        return view('guest_image_details', compact('img'));
    }

    public function reorder_welcome (Request $request){
        $filter = $request->filter;
        #dd($filter);
        $images = DB::table('images')->get()->sortBy($filter);
        $liked = collect();
        return view('welcome', compact('images','liked','filter'));
    }
}
