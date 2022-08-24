<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Images;
use Auth;

class UploadController extends Controller
{
    //upload images to Database
    public function up(Request $request){
        $validatedData = $request->validate([
          'title' => 'required|unique:images',
          'artist' => 'required|max:255',
          'description' => 'required',
          'image' => 'required',
          'price' => 'required|numeric',
        ]);
        $newImageName = time(). '-'. $request->title . '.'. $request->image->extension();
        $path = public_path('images/'. $newImageName);
        $request->image->move(public_path('images'),$newImageName);
        $img = new Images();
        $img->title = $request->title;
        $img->artist = $request->artist;
        $img->description = $request->description;
        $img->image_path = $newImageName;
        $img->price = str_replace(',','.', $request->price);
        $img->user_id = Auth::user()->id;
        $img->sold = $request->has('sold');
        $img->unique = $request->has('unique');

        $img->save();

        return redirect('dashboard')->with('status', 'Form Data Has Been Inserted');

    }
}
