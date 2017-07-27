<?php

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

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::get('messages', function () {
   return \App\Message::with('user')->get();
})->middleware('auth');

Route::post('messages', function () {
    $message = new \App\Message();

    $message->message = request()->get('message');
    $message->user_id = Auth::user()->id;

    $message->save();

    return ['status' => 'OK'];
})->middleware('auth');