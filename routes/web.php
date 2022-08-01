<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Route;

Route::get('/{any}', function (){
//    $setting123=[];
//    $setting123[0] = Setting::all();

    return view('app', ['title'=>Setting::where("key", "title")->first()?->value??'']);
})->where('any','.*');



