<?php

use Illuminate\Support\Facades\Route;

$namepace = 'Khapu\ManagerFiles\Http\Controllers';

Route::namespace($namepace)->prefix('khapu-manage-files')->group(function () 
{
    Route::get('/create', 'DashboardController@create');
    Route::get('/{fileName?}', 'DashboardController@index')->where('fileName', '.*');

});