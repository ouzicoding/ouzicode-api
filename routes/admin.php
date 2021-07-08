<?php

use Illuminate\Support\Facades\Route;


Route::get('/',function (){
    return 'hello admin';
});

Route::post('/admin/login',[LoginController::class,'login']);
