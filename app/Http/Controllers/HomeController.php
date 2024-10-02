<?php

namespace App\Http\Controllers;

use App\Models\pemasukan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = pemasukan::get();
        return view("index")->with('data', $data);
    }
}
