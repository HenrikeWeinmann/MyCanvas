<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Checkout;
use App\Models\GuestCheckout;
use App\Models\Order;
use App\Models\OrderedItem;
use Auth;

class CheckoutController extends Controller
{
    public function checkout(){
        $items = DB::table('checkout')->where('user_id',Auth::user()->id)->get();
        $total = $this->get_total($items);
        return view('checkout', compact('items','total'));
    }

    public function cart(){
        $items = DB::table('checkout')->where('user_id',Auth::user()->id)->get();
        $total = $this->get_total($items);
        return view('cart', compact('items','total'));
    }

    public function add_to_cart(Request $request){
        $validatedData = $request->validate([
          'img_id' => 'required',
          'unique' => 'required',
        ]);
        $message = 'added to cart successfully';
        $cart =  DB::table('checkout')->pluck('image_id');
        if($cart->contains($request->img_id)){
            if(!$request->unique){
            $qty =DB::table('checkout')->where('user_id',Auth::user()->id)->where('image_id',$request->img_id)->first()->qty;
            $newqty = $qty+1;
            DB::table('checkout')->where('user_id',Auth::user()->id)->where('image_id',$request->img_id)->update(['qty' => $newqty]);
            }
            else {
                $message = 'item can only be added once';
            }
        }
        else{
        $img =  DB::table('images')->where('id',$request->img_id)->first();
        #dd($img);
        $cart = new Checkout();
        $cart->image_id = $img->id;
        $cart->sold=$img->sold;
        $cart->title=$img->title;
        $cart->image_path=$img->image_path;
        $cart->price=$img->price;
        $cart->artist=$img->artist;
        $cart->unique=$img->unique;
        $cart->qty = 1;
        $cart->user_id = Auth::user()->id;
        $cart->save();
        }
        $items = DB::table('checkout')->where('user_id',Auth::user()->id)->get();
        session()->put('cart',count($items));
        return redirect()->back()->with('message', $message);
    }

    public function remove(Request $request){
        $validatedData = $request->validate([
          'item_id' => 'required',
        ]);
        DB::table('checkout')->where('user_id',Auth::user()->id)->where('id',$request->item_id)->delete();
        $items = DB::table('checkout')->where('user_id',Auth::user()->id)->get();
        session()->put('cart',count($items));
        return redirect()->back();
    }

    public function order(Request $request){
        $validatedData = $request->validate([
             'name' => 'required',
             'firstname' => 'required',
             'street' => 'required',
             'city' => 'required',
             'country' => 'required',
             'zip' => 'required',
        ]);
        $images = DB::table('images')->get();
        $items = DB::table('checkout')->get();

        $total = $this->get_total($items);
        $order = new Order();
        $order->name = $request->name;
        $order->firstname=$request->firstname;
        $order->city=$request->city;
        $order->street=$request->street;
        $order->country=$request->country;
        $order->zip=$request->zip;
        $order->total = $total;
        $order->user_id = Auth::user()->id;
        $order->save();
        $this->process_order($items,$order);
        return view('order', compact('items','total'));
    }

    public function process_order($items,$order){
        #mark images as sold and add to ordered items
        foreach($items as $item){
            $img = DB::table('images')->where('id',$item->image_id)->first();
            if ($img->unique) {
                DB::table('images')->where('id',$item->image_id)->update(['sold' => 1]);
            }
            $orderedItem = new OrderedItem();
            $orderedItem->order=$order->id;
            $orderedItem->user_id=$order->user_id;
            $orderedItem->image_id=$item->id;
            $orderedItem->qty=$item->qty;
            $orderedItem->price=$item->price;
            $orderedItem->save();
        }
        #clear cart
        DB::table('checkout')->where('user_id',Auth::user()->id)->delete();
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

    public function edit_qty(Request $request){
        $validatedData = $request->validate([
          'img_id' => 'required',
          'qty' => 'required',
        ]);
        DB::table('checkout')->where('user_id',Auth::user()->id)->where('image_id',$request->img_id)->update(['qty' => $request->qty]);
        return redirect()->back();
    }
}
