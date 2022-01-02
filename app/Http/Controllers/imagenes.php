<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class imagenes extends Controller
{
    public function index()
    {
        return view('image.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('image')) 
        {
            $file = $request -> file('image');
            $random = time();
            $nombre = $random.'_'.$file -> getClientOriginalName();
            $path = public_path('uploads/');
            $file -> move($path, $nombre);
            $url = $path."".$nombre;

            //Conversino de formatos
            $convertible = Image::make(public_path('uploads/'.$nombre)) ->encode('webp',75);
            $convertible->save(public_path('uploads/'."WEBP_"));

            $convertible = Image::make(public_path('uploads/'.$nombre)) ->encode('png',75);
            $convertible->save(public_path('uploads/'."PNG_"));

            $convertible = Image::make(public_path('uploads/'.$nombre)) ->encode('gif',75);
            $convertible->save(public_path('uploads/'."GIF_"));

            $convertible = Image::make(public_path('uploads/'.$nombre)) ->encode('jpg',75);
            $convertible->save(public_path('uploads/'."JPG_"));
        }
        return "OK";
    }

    public function redimensionar(Request $request)
    {
        $file = $request -> file('image');
        $random = time();
        $nombre = $random.'_'.$file -> getClientOriginalName();
        $path = public_path('uploads/');
        $file -> move($path, $nombre);
        $url = $path."".$nombre; 
        $rszble = Image::make(public_path('uploads/'.$nombre));
        $rszble->resize(800, 800, function ($constraint) {
            $constraint->aspectRatio();
        });
        $rszble->save(public_path('uploads/'.$nombre),75);

        return "OK";
    }
}
