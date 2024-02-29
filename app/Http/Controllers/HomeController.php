<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function makeimage()
    {
//        $file = public_path('uploads/school/3U8hdvoDe7.png');
//        $img = Image::make($file)
//            ->resize(320, 240)
//            ->save('public/uploads/', $file->getClientOriginalName());
//        $img = Image::make($image->getRealPath);
//        $img->text('This is a example ', 120, 100);
//        $img->save(public_path('uploads/hardik3.jpg'));
    }
}
