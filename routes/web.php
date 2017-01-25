<?php


use Illuminate\Support\Facades\Route;

Route::get('/index', function () { return view('seccion_principal'); });

Route::get('/contactar', function () { return view('seccion_contactar'); });

Route::get('/acerca_de', function () { return view('seccion_acerca_de'); });
