<?php

Route::group(['prefix' => 'redirects', 'as' => 'redirects.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'RedirectController@index')->name('index');
    Route::get('create', 'RedirectController@create')->name('create');
    Route::post('', 'RedirectController@store')->name('store');
    Route::get('{id}/edit', 'RedirectController@edit')->name('edit');
    Route::put('{id}', 'RedirectController@update')->name('update');
    Route::delete('{id}', 'RedirectController@destroy')->name('destroy');
});