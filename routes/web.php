<?php

use Illuminate\Support\Facades\Route;

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
    return view('posts');
});

Route::get('/posts/{post}', function ($slug){
//    dd($slug);
//    dd(__DIR__);
    $path =__DIR__."/../resources/posts/{$slug}.html";
    //ddd($path);
    if(!file_exists($path)){
        //dd('What are you doing bro?');
        //abort(404);
        return redirect('/');
    }
    $post = cache()->remember("posts.{$slug}", 10, fn () => file_get_contents($path));
    //$post = file_get_contents($path);

    return view('post',['post' => $post]);
})->where('post', '[A-z_\-]+');
