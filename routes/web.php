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



Auth::routes();

Route::get('/', 'PagesController@home')->name('inicio');
Route::get('/home', 'HomeController@index')->name('home');


Route::group([
    'prefix'=>'admin', //prefijo para no poner admin/posts
    'namespace'=>'admin',//namespace para no poner admin\PostsController@index
    'middleware'=>'auth'],//midleware para controlar el acceso
function(){
    Route::get('/', 'AdminController@index')->name('dashboard'); 

});