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
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::post('/logout',[UserController::class,'logout']);

Route::get('/singlepost',[UserController::class,'singePost']);


// Post Controller
Route::get('/createpost',[PostController::class,'createPost']);
Route::post('/createpost',[PostController::class,'savePost']);

