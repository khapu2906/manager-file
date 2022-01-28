<?php

use Illuminate\Support\Facades\Route;

$namepace = 'Khapu\ManagerFiles\Http\Controllers';

Route::namespace($namepace)->prefix('khapu-manage-files')->group(function () 
{
    Route::get('/test', 'DashboardController@test');
    Route::get('/create', 'DashboardController@create');
    Route::get('/rename/{fileName}/{newName}', 'DashboardController@rename')
        ->where([
            'fileName' => '.*',
            'nameName' => '.*'
        ]);
    Route::get('/delete/{fileName?}', 'DashboardController@delete')->where('fileName', '.*');
    Route::get('/{fileName?}', 'DashboardController@index')->where('fileName', '.*');
});