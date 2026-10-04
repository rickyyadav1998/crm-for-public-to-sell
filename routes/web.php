<?php
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
Route::get('/',fn()=>redirect('/app'));
Route::get('/app',[DashboardController::class,'index'])->name('dashboard');
Route::get('/up',fn()=>response()->json(['status'=>'ok']));
