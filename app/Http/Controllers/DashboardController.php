<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Wishlist;
use Auth;

class DashboardController extends Controller
{

    public function index(){
        $items = DB::table('checkout')->where('user_id',Auth::user()->id)->get();
        $images = DB::table('images')->get();
        $liked = DB::table('wishlist')->where('user_id',Auth::user()->id)->pluck('image_id');
        return view('dashboard', compact('images','liked','items'));
    }

    public function upload (){
        return view('upload');
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
    public function reorder (Request $request){
        $filter = $request->filter;
        #dd($filter);
        $images = DB::table('images')->get()->sortBy($filter);
        $liked = DB::table('wishlist')->where('user_id',Auth::user()->id)->pluck('image_id');
        return view('dashboard', compact('images','liked','filter'));
    }

    public function show_details(Request $request){
        $validatedData = $request->validate([
          'img_id' => 'required',
        ]);
        $img = DB::table('images')->where('id',$request->img_id)->first();
        $seller =  DB::table('users')->where('id',$img->user_id)->first();
        return view('image_details', compact('img','seller'));
    }
}
