<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola', function () {
    return "Hola Mundo <br> Muajajaja";
});

//Route::function('/listaInmuebles/{$provincia}', )
