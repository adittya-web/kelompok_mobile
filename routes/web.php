<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BokingController;
use App\Http\Controllers\ControllerService;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('services',ControllerService::class);
