<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function informasi()
    {
        return view('front.info');
    }
    public function pendaftaran()
    {
        return view('front.pendaftaran');
    }
}
