<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return view('admin');
})->where('any','.*');

Route::get('/{any}', function (){
    return view('admin');
})->where('any','.*');
