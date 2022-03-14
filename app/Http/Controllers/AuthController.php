<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function home()
    {
        return view('quantrivien.index');
    }

    public function home3()
    {
        return view('sinhvien.index');
    }
}
