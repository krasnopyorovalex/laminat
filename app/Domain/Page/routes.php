<?php

Route::group(['prefix' => 'pages', 'as' => 'pages.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'PageController@index')->name('index');
    Route::get('create', 'PageController@create')->name('create');
    Route::post('', 'PageController@store')->name('store');
    Route::get('{id}/edit', 'PageController@edit')->name('edit');
    Route::put('{id}', 'PageController@update')->name('update');
    Route::delete('{id}', 'PageController@destroy')->name('destroy');

});