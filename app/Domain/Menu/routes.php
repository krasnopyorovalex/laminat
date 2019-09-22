<?php

Route::group(['prefix' => 'menus', 'as' => 'menus.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'MenuController@index')->name('index');
    Route::get('create', 'MenuController@create')->name('create');
    Route::post('', 'MenuController@store')->name('store');
    Route::get('{id}/edit', 'MenuController@edit')->name('edit');
    Route::put('{id}', 'MenuController@update')->name('update');
    Route::delete('{id}', 'MenuController@destroy')->name('destroy');

});