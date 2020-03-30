<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'welcome',
    'namespace' => 'RazeSoldier\Seat3VWelcome\Http\Controller',
    'middleware' => ['web', 'auth', 'locale'],
], function () {
    Route::get('/', 'WelcomeController@showMainPage')->name('welcome.main');
    Route::post('/bind-qq', 'WelcomeController@bindQQ')->name('welcome.bindqq');
    Route::post('/switch-lang', 'WelcomeController@switchLang')->name('welcome.switch-lang');
});
