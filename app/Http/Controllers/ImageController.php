<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Image;

class ImageController extends Controller
{
    //show all image function

    public function AllImage(){

        $images = Image::all();
        return view('image.index',compact('images'));
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


    // image edit function 
    public function Edit($id){
        $images = Image::find($id);
        return view('image.edit',compact('images'));
    }


    public function Update(Request $request, $id){
         $validated = $request->validate([
        'name' => 'required|min:4',
        'description' => 'required',
    ]);
    $image = $request->file('img');
    $old_img = $request->old_img;
    if($image){
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $upload_loction = 'images/uploaded/';
        $last_image = $upload_loction.$img_name;
        $image->move($upload_loction,$img_name);
        unlink($old_img);

    Image::find($id)->update([
        'name' => $request->name,
        'img'   =>$last_image,
        'description' => $request->description,
        'updated_at' => Carbon::now()
    ]);

    return Redirect()->route('all.image')->with('success','Image updated successfully');
    }else{

        Image::find($id)->update([
        'name' => $request->name,
        'updated_at' => Carbon::now()
    ]);

    return Redirect()->route('all.image')->with('success','Image name updated successfully');

    }
    
    }

    // delete function 

    public function Delete($id){
        $image = Image::find($id);
        $old_img = $image->img;
        Image::find($id)->delete();
        unlink($old_img);
        return Redirect()->back()->with('success','Image deleted successfully');
    }
}
