<?php

use Illuminate\Support\Facades\Route;
use App\Models\Vendedor;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola', function () {
    return "Hola Mundo <br> Muajajaja";
});

Route::get('/vendedores', function () {
    $vendedores = Vendedor::all();
    return $vendedores;
});

Route::get('/vendedor/cantidad', function () {
    $vendedor = Vendedor::count();
    return $vendedor;
});

Route::get('/vendedor/sueldo-alto',function () {

    $vendedores = Vendedor::where('sueldo_base','>','50000')->get();
    return $vendedores;
    
});

Route::get('/vendedor/sueldo-between',function () {

    $vendedores = Vendedor::whereBetween('sueldo_base',[30000,70000])->get();
    return $vendedores;
    
});

Route::get('/vendedor/sueldo-alto',function () {

    $vendedores = Vendedor::where('sueldo_base','>','50000')->get();
    return $vendedores;
    
});

Route::get('/vendedor/contar-sueldo-alto',function () {

    $vendedores = Vendedor::where('sueldo_base','>','50000')->count();
    return $vendedores;
    
});

Route::get('/vendedor/max-sueldo',function () {

    $vendedores = Vendedor::max('sueldo_base');
    return $vendedores;
    
});

Route::get('/vendedor/idin',function () {

    $vendedores = Vendedor::whereIn('id',[3,7,12,167,34])->get();
    return $vendedores;
    
});

Route::get('/vendedor/sueldoynombre',function () {

    $vendedores = Vendedor::where('sueldo_base','>','20000')
    ->where('nombre','like','M%')
    ->orderBy('sexo','desc')
    ->orderBy('nombre')->get();
    return $vendedores;
    
});

Route::get('/vendedor/triplecondicion/',function () {

    $vendedores = Vendedor::where('sueldo_base','>','50000')
    ->where(function ($query)
    {
        $query->where('nombre','like','M%')
        ->orWhere('sexo','=','F');
    })->get();
   
    return $vendedores;
    
});

Route::get('/vendedor/{id}', function ($id) {
    $vendedor = Vendedor::findorFail($id);
    return $vendedor;
});

Route::get('/primero', function () {
    $vendedor = Vendedor::orderBy('nombre')->first();
    return $vendedor;
});

Route::get('/ultimo', function () {
    $vendedor = Vendedor::orderBy('nombre', 'desc')->first();
    return $vendedor;
});

Route::get('/ultimo', function () {
    $vendedor = Vendedor::orderBy('nombre', 'desc')->first();
    
    return $vendedor;
});


