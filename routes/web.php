<?php

use App\Exports\UsersExport;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\UserController;
use App\Models\pemasukan;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/export-users', function (){
    return Excel::download(new UsersExport, 'users.xlsx');
});
Route::get('/export-users', [UserController::class, 'export']);
Route::resource("/pemasukan",FamilyController::class)->middleware(['auth','multiuser']);
Route::resource("/dashboard",indexController::class)->middleware(['isLogin', 'multiuser']);
Route::resource("/dashboard1",FamilyController::class)->middleware(['isLogin']);
Route::resource("/pengeluaran", PengeluaranController::class)->middleware(['auth','multiuser']);
Route::get('/',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'login'])->middleware('isTamu');
Route::get('/logout' ,[LoginController::class, 'logout']);
// Route::get('/admin', [LoginController::class, 'index'])
//     ->middleware('multiuser:admin');
