<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GuestCheckout;
use App\Models\Order;
use App\Models\OrderedItem;
use Auth;
use Session;

class GuestCheckoutController extends Controller
{
    //
    public function guest_cart(){
        $items = DB::table('guest_checkout')->where('user_id',session()->getid())->get();
        $total = $this->get_total($items);
        return view('guest_cart', compact('items','total'));
    }

    public function guest_checkout(){
        $items = DB::table('guest_checkout')->where('user_id',session()->getid())->get();
        $total = $this->get_total($items);
        return view('guest_checkout', compact('items','total'));
    }

    public function guest_order(Request $request){
        $validatedData = $request->validate([
             'name' => 'required',
             'firstname' => 'required',
             'street' => 'required',
             'city' => 'required',
             'country' => 'required',
             'zip' => 'required',
        ]);
        $images = DB::table('images')->get();
        $items = DB::table('guest_checkout')->get();

        $total = $this->get_total($items);
        $order = new Order();
        $order->name = $request->name;
        $order->firstname=$request->firstname;
        $order->city=$request->city;
        $order->street=$request->street;
        $order->country=$request->country;
        $order->zip=$request->zip;
        $order->total = $total;
        $order->user_id = session()->getid();
        $order->save();
        $this->process_order($items,$order);
        return view('guest_order', compact('items','total'));
    }

    public function add_to_guest_cart(Request $request){
        $validatedData = $request->validate([
          'img_id' => 'required',
        ]);
        $cart =  DB::table('guest_checkout')->where('user_id',session()->getid())->pluck('image_id');
        if($cart->contains($request->img_id)){
            $qty =DB::table('guest_checkout')->where('user_id',session()->getid())->where('image_id',$request->img_id)->first()->qty;
            $newqty = $qty+1;
            DB::table('guest_checkout')->where('user_id',session()->getid())->where('image_id',$request->img_id)->update(['qty' => $newqty]);
        }
        else{
        $img =  DB::table('images')->where('id',$request->img_id)->first();
        $cart = new GuestCheckout();
        $cart->image_id = $img->id;
        $cart->sold=$img->sold;
        $cart->title=$img->title;
        $cart->image_path=$img->image_path;
        $cart->price=$img->price;
        $cart->artist=$img->artist;
        $cart->unique=$img->unique;
        $cart->qty = 1;
        $cart->user_id = session()->getid();
        $cart->save();
        }
        $items = DB::table('guest_checkout')->where('user_id',session()->getid())->get();
        session()->put('cart',count($items));
        return redirect()->back()->with('message', 'added to cart successfully');
    }

    public function show_details(Request $request){
        $img = $request->img;
        return view('image_details', compact('img'));
    }

    public function guest_remove(Request $request){
        $validatedData = $request->validate([
          'item_id' => 'required',
        ]);
        DB::table('guest_checkout')->where('user_id',session()->getid())->where('id',$request->item_id)->delete();
        $items =  DB::table('guest_checkout')->where('user_id',session()->getid())->get();
        session()->put('cart',count($items));
        return redirect()->back();
    }
    public function get_total($items){
        $total = 0;
        foreach($items as $item){
        $price = $item->price;
        $quantity = $item->qty;
        $total += ($price*$quantity);
        }
        return $total;
    }

    public function guest_edit_qty(Request $request){
        $validatedData = $request->validate([
          'img_id' => 'required',
          'qty' => 'required',
        ]);
        DB::table('guest_checkout')->where('image_id',$request->img_id)->update(['qty' => $request->qty]);
        return redirect()->back();
    }

    public function process_order($items,$order){
        #mark images as sold and add to ordered items
        foreach($items as $item){
            DB::table('images')->where('id',$item->image_id)->update(['sold' => 1]);
            $orderedItem = new OrderedItem();
            $orderedItem->order=$order->id;
            $orderedItem->user_id=$order->user_id;
            $orderedItem->image_id=$item->id;
            $orderedItem->qty=$item->qty;
            $orderedItem->price=$item->price;
            $orderedItem->save();
        }
        #clear cart of session
        DB::table('guest_checkout')->where('user_id',session()->getid())->delete();
    }
}
