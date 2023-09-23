<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Models\Photo;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    //index function
    public function index()
    {
        return view('tpl.index');
    }
    public function upload(Request $request)
    {
        // use Illuminate\Support\Facades\Validator;
        // Validator facade use pananum "make()" method use panarom
        // $request-> all() kudutha ellam fields sum check pannum
        $validation = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'image' => 'required|image'
        ]);

        // $validation = Validator::make($request->all(),
        // Photo::$upload_rules);
        // use Illuminate\Support\Facades\Redirect;
        //"if ($validation->fails())" if this condition is fails this will return the true.
        if ($validation->fails()) { //this will return "True"
            //withInput method will request ku send panna ella datavum kondu pogum
            //withErrors method error kondu pogum
            return Redirect::to('/')->withInput()->withErrors($validation);
        } else {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $filename = pathinfo($filename, PATHINFO_FILENAME);
            $fullname = Str::slug(Str::random(8) . $filename) . '.' . $image->getClientOriginalExtension();
            $upload = $image->move(Config::get('image.uploads_folder'), $fullname);
            Image::make(Config::get('image.uploads_folder') . '/' . $fullname)->resize(Config::get('image.thumb_width'), Config::get('image.thumb_height'))->save(Config::get('image.thumb_folder') . '/' . $fullname);


            if ($upload) {
                $insert_id =  DB::table('photos')->insertGetId(array(
                    'title' => $request->input('title'),
                    'image' => $fullname
                ));
                return Redirect::to(URL::to('snatch/' . $insert_id))->with('success', 'Your image is uploaded successfully');
            } else {
                return Redirect::to('/')->withInput()->with('error', 'please Try again !!!');
            }
        }
    }


    public function snatch($id)
    {
        $image = Photo::find($id);
        if ($image) {
            return view('tpl.permalink')->with('image', $image);
        } else {
            return Redirect::to('/')->with('error', 'Image not Found');
        }
    }

    public function delete($id)
    {
        $image = Photo::find($id);
        if ($image) {
            File::delete(Config::get('image.uploads_folder') . '/' . $image->image);
            File::delete(Config::get('image.thumb_folder') . '/' . $image->image);
            $image->delete();
            return Redirect::to('/')->with('success', 'Image Deleted successfully');
        } else {
            return Redirect::to('/')->with('error', 'No Image Found');
        }
    }

    public function all()
    {
        $all_images = DB::table('photos')->orderBy('id', 'desc')->paginate(6);
        return view('tpl.all_images')->with('images', $all_images);
    }
}
