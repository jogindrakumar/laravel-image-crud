<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Image;

class ImageController extends Controller
{
    //show all image function

    public function AllImage(){
        return view('image.index');
    }

    // insert image function

    public function AddImage(Request $request){
        $validated = $request->validate([
        'name' => 'required|unique:images|min:4',
        'img' => 'required|mimes:png,jpg,jpeg',
        'description' => 'required',
    ]);

    $image = $request->file('img');
    $name_gen = hexdec(uniqid());
    $img_ext = strtolower($image->getClientOriginalExtension());
    $img_name = $name_gen.'.'.$img_ext;
    $upload_loction = 'images/uploaded/';
    $last_image = $upload_loction.$img_name;
    $image->move($upload_loction,$img_name);

    Image::insert([
        'name' => $request->name,
        'img'   =>$last_image,
        'description' => $request->description,
        'created_at' => Carbon::now()
    ]);

    return Redirect()->back()->with('success','Image inserted successfully');
    }
}
