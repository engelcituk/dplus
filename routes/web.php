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
    Route::resource('categories', 'CategoriesController',['as'=>'admin']);  
    Route::resource('periododias', 'PeriodosDiasController',['as'=>'admin']);//as es para agregar el prefijo admin al nombre de las rutas 
    Route::resource('users', 'UsersController',['as'=>'admin']);  
    Route::resource('roles', 'RolesController',['except'=>'show','as'=>'admin']); //except para omitir la ruta show 
    Route::resource('permissions', 'PermissionsController',['only'=>['index','edit','update'],'as'=>'admin']); //only para aceptar ciertos metodos
    
    Route::middleware('role:Admin')
        ->put('users/{user}/roles','UsersRolesController@update')
        ->name('admin.users.roles.update');//roles update
    Route::middleware('role:Admin')
        ->put('users/{user}/permissions','UsersPermissionsController@update')
        ->name('admin.users.permissions.update');//permisos update   

    Route::resource('clientes', 'ClientesController',['as'=>'admin']); 
    Route::resource('television', 'TelevisionController',['as'=>'admin']); 
    Route::resource('internet', 'InternetsController',['as'=>'admin']); 

    Route::resource('printers', 'PrintersController',['as'=>'admin']);  
    Route::resource('products', 'ProductsController',['as'=>'admin']);  


    Route::post('prints/shared', 'PrintsController@sharedPrinterTest')->name('admin.prints.compartido'); 
    //area de ventas
    Route::get('ventas', 'VentasController@index')->name('admin.ventas.index'); 
    Route::get('ventas/clienteservicios', 'VentasController@getClientesServicios')->name('admin.ventas.clientesservicios'); 
    Route::get('ventas/listaproductos', 'VentasController@getListaProductos')->name('admin.ventas.listaproductos'); 
    Route::get('ventas/datostvservicio', 'VentasController@getDatosServicioTv')->name('admin.ventas.datostvservicio'); 


}); 