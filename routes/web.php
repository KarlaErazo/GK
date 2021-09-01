<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/api/list/all', function () {
    return \App\Models\Post::all();
});

Route::get('/api/list/type', function (Request $request) {
    return \App\Models\Post::where('type',$request->name)->get();
});

Route::get('/api/list/post', function (Request $request) {
    return \App\Models\Post::find($request->id);
});

require __DIR__.'/auth.php';
