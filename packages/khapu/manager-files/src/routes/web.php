<?php

use Illuminate\Support\Facades\Route;

$namepace = 'Khapu\ManagerFiles\Http\Controllers';

Route::namespace($namepace)->prefix('khapu-manage-files')->group(function () 
{
    // Route::get('/open/{fileName}', 'DashboardController@open');
    Route::get('/{fileName?}', 'DashboardController@index')->where('fileName', '.*');

});