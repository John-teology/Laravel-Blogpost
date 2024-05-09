<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
# test is the same name of controller method/function and its case sensitive
// Route::get('/test/{name}',[ExampleController::class,'test']);

// User Controller
Route::get('/',[UserController::class,'homepage']);
Route::post('/register',[UserController::class,'register'])->middleware('guest');
Route::post('/login',[UserController::class,'login'])->middleware('guest');
Route::post('/logout',[UserController::class,'logout'])->middleware('auth2');
Route::get('/profile/{user:username}',[UserController::class,'showProfile']); // {user} should be automatically ID pero if gusto mo customize pwede rin {user:username} or {user:age} etc

// Route::get('/singlepost',[UserController::class,'singePost']);


// Post Controller
Route::get('/createpost',[PostController::class,'createPost'])->middleware('auth2'); // newly created middleware by me
// pag nag create ng middleware dapat register sa kernel.php
Route::post('/createpost',[PostController::class,'savePost'])->middleware('auth2');
Route::get('/post/{post}',[PostController::class,'getPost']);



// Route::get('/',[UserController::class,'homepage'])->name('login'); // name is used to give a name to the route

// Route::get('/createpost',[PostController::class,'createPost'])->middleware('auth');

// middleware is used to check if the user is authenticated, and it runs before the controller method

// midelware('guest') is used to check if the user is not authenticated

// you can modify the redirect url of mideleware in app/Http/Middleware/... so on mamili ka nalang anong middleware ang gagamitin mo  