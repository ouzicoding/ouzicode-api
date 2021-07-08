<?php

use Illuminate\Support\Facades\Route;


Route::get('/',function (){
    return 'hello admin';
});


Route::post('/login',[\App\Http\Controllers\Admin\LoginController::class,'login']);
