<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
function index(){
    return view('login');
}

function login(Request $request)
{
    Session::flash('name', $request->input('email'));

    $request->validate([
        'name' => 'required',
        'password' => 'required',
    ],[
        'name.required' => 'name wajib diisi',
        'password.required' => 'Password wajib diisi'
    ]);

    $infologin = [
        'name' => $request->name,
        'password' => $request->password,
    ];
    if (Auth::attempt($infologin)) {
        return redirect('/dashboard1')->with('success' ,  Auth::user()->name.' Selamat Datang');
    } else {
        return redirect('/')->withErrors('Username Atau Password Tidak Sesuai');
    }
}
function logout()
{
    Auth::logout();
    return redirect('/')->with('success', 'Berhasil logout');
}

}
