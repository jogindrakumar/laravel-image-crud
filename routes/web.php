<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


//image route

Route::get('/image/all',[ImageController::class,'AllImage'])->name('all.image');

Route::post('/image/add',[ImageController::class,'AddImage'])->name('store.image');

// edit route

Route::get('/image/edit/{id}',[ImageController::class,'Edit']);

Route::post('/image/update/{id}',[ImageController::class,'Update']);

// image delete route

Route::get('/image/delete/{id}',[ImageController::class,'Delete']);
