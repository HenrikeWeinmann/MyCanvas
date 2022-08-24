<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Follower;
use Auth;
use File;

class ProfileController extends Controller
{
    public function show (){
        $images = self::get_images();
        return view('profile',compact('images'));
    }
    public function edit (Request $request){
        $validatedData = $request->validate([
          'img_id' => 'required',
        ]);
        $img = DB::table('images')->where('id' ,$request->img_id)->first();
        return view('modify',compact('img'));
    }
    public function get_images(){
        $images = DB::table('images')->where('user_id' ,'=' , Auth::user()->id)->get();
        return $images;
    }
    public function update_image(Request $request){
        $validatedData = $request->validate([
            'title' => 'required',
            'artist' => 'required|max:255',
            'description' => 'required',
            'img_id' => 'required',
            'price' => 'required|numeric',
        ]);
        DB::table('images')->where('id',$request->img_id)->update([
            'title' => $request->title,
            'artist' => $request->artist,
            'price' => $request->price,
            'description' => $request->description,
            'sold' => $request->has('sold'),
            'unique' => $request->has('unique'),
        ]);
        return self::show();
    }
    public function delete(Request $request){
        $validatedData = $request->validate([
          'img_id' => 'required',
        ]);
        $img =DB::table('images')->where('id',$request->img_id)->first();
        $path ="images/".$img->image_path;
        File::delete($path);
        DB::table('images')->where('id',$request->img_id)->delete();
        return redirect()->back();
    }
    public function show_orders(Request $request){
        $validatedData = $request->validate([
          'img_id' => 'required',
        ]);
        $img = DB::table('images')->where('id',$request->img_id)->first();
        $items = DB::table('ordered_items')->where('image_id',$request->img_id)->get();
        if (count($items) > 0 ) {
        $order_ids = $items->pluck('order');
        $orders = DB::table('orders')->where('id',$order_ids)->get();
        $orders->map(function($item) use($img){
            $quantity = DB::table('ordered_items')->where('image_id',$img->id)->where('order',$item->id)->first();
            $item->qty = $quantity->qty;
            $prc = DB::table('ordered_items')->where('image_id',$img->id)->where('order',$item->id)->first();
            $item->price = $prc->price;
            return $item;
        });
        }
        else {
            $orders = collect();
        }
        return view('image_orders', compact('img','orders'));
    }
    public function follow(Request $request){
        $validatedData = $request->validate([
          'follow_id' => 'required',
        ]);
        $follow = new Follower();
        $follow->user_id = Auth::user()->id;
        $follow->followed_user_id = $request->follow_id;
        $follow->save();

        return redirect('/dashboard');
    }
    public function unfollow(Request $request){
        $validatedData = $request->validate([
          'name' => 'required',
        ]);
        $id = DB::table('users')->where('name',$request->name)->pluck('id');
        #dd($id);
        DB::table('followers')->where('user_id',Auth::user()->id)->where('followed_user_id',$id)->delete();
        return redirect('/dashboard');
    }
    public function search(Request $request){
        $validatedData = $request->validate([
          'search' => 'required',
        ]);
        $val = DB::table('users')->where('name',$request->search)->count();
        $result = null;
        if($val >0){
            $result = DB::table('users')->where('name',$request->search)->get();
            $found = true;
        }
        else {
            $result = DB::table('users')->where('name','!=',$request->search)->get();
            $found = false;
        }
        $all_images =collect();
        foreach ($result as $key => $value) {
            $img =DB::table('images')->where('user_id',$value->id)->orderBy('created_at','desc')->first();
            $all_images->put($value->id, $img->image_path);
        }
        return redirect()->back()->with(['search' => $result, 'found' => $found,'all_images' => $all_images]);
        #return redirect()->back()->withInput($result);
    }
}
