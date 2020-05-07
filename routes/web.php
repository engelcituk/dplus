<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'PagesController@home')->name('home');
//Route::get('/home', 'HomeController@index')->name('home');


Route::group([
    'prefix'=>'admin', //prefijo para no poner admin/posts
    'namespace'=>'admin',//namespace para no poner admin\PostsController@index
    'middleware'=>'auth'],//midleware para controlar el acceso
function(){
    Route::get('/', 'AdminController@index')->name('dashboard'); 
    Route::get('ventas', 'VentasController@index')->name('admin.ventas.index'); 
    Route::resource('periododias', 'PeriodosDiasController',['as'=>'admin']);//as es para agregar el prefijo admin al nombre de las rutas 
    Route::resource('users', 'UsersController',['as'=>'admin']);     
    Route::resource('clientes', 'ClientesController',['as'=>'admin']); 
    Route::resource('television', 'TelevisionController',['as'=>'admin']); 
    Route::resource('internet', 'InternetsController',['as'=>'admin']); 

    //Route::post('clientesky/{cliente}', 'ClientesServiciosController@skyStore')->name('admin.clientes.skystore'); 
    //Route::put('clienteskyedit/{cliente}', 'ClientesServiciosController@skyUpdate')->name('admin.clientes.skyedit'); 
}); 