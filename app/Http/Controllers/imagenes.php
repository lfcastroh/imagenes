<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Imagick;

class imagenes extends Controller
{
    public function index()
    {
        return view('image.index');
    }


    public function bg(Request $request)
    {

        $file = $request -> file('image');
        $random = time();
        $nombre = $random.'_'.$file -> getClientOriginalName();
        $path = public_path('uploads/');
        $file -> move($path, $nombre);
        $url = $path."".$nombre;
        $savinf = public_path('uploads/'.'wbg_'.$nombre);
        $imgick = new Imagick(public_path('uploads/'.$nombre));
        $aTaille=$imgick->getImageGeometry();
        $colorToTransparent=$imgick->getImagePixelColor(0,0); 
        
        $imgick->borderImage($colorToTransparent, 10, 10);

        $imgick->floodFillPaintImage("rgb(118, 125, 137)", 2500, $colorToTransparent, 0 , 0, false);

        $imgick->transparentPaintImage("rgb(118,125,137,)", 0, 100, false);

        $imgick->cropImage($aTaille['width'], $aTaille['height'], 10, 10);

        $imgick->setImageFormat('png'); 

        # set header type as PNG image
        header('Content-Type: image/png');
        # output the new image
        echo $imgick->getImageBlob();
        $imgick->writeImage($path."wbg.png");

    }


    public function border(Request $request)
    {

        $file = $request -> file('image');
        $random = time();
        $nombre = $random.'_'.$file -> getClientOriginalName();
        $path = public_path('uploads/');
        $file -> move($path, $nombre);
        $url = $path."".$nombre;
        $savinf = public_path('uploads/'.'border_'.$nombre);
        $imgick = new Imagick(public_path('uploads/'.$nombre));
        $aTaille=$imgick->getImageGeometry();
        //$colorToTransparent=$imgick->getImagePixelColor(0,0); 
        $colorToTransparent='rgba(255, 0, 0, 0)';
        
        $imgick->borderImage($colorToTransparent, 10, 10);
/*
        $imgick->floodFillPaintImage("rgb(255, 0, 255)", 2500, $colorToTransparent, 0 , 0, false);

        $imgick->transparentPaintImage("rgb(255,0,255)", 0, 100, false);

        $imgick->cropImage($aTaille['width'], $aTaille['height'], 10, 10);
*/
        $imgick->setImageFormat('png'); 

        # set header type as PNG image
        header('Content-Type: image/png');
        # output the new image
        echo $imgick->getImageBlob(); 
        $imgick->writeImage($savinf);

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
