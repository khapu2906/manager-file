<?php

use Illuminate\Support\Facades\Route;

$namepace = 'Khapu\ManagerFiles\Http\Controllers';

Route::namespace($namepace)->group(function () 
{
    Route::get('khapu-manage-files', 'DashboardController@index');
});