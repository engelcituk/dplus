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
    Route::resource('categorias', 'CategoriesController',['as'=>'admin']); //as es para agregar el prefijo admin al nombre de las rutas
    Route::resource('clientes', 'ClientesController',['as'=>'admin']); //as es para agregar el prefijo admin al nombre de las rutas
    Route::resource('servicios', 'ServiciosController',['as'=>'admin']); //as es para agregar el prefijo admin al nombre de las rutas

});