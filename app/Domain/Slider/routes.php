<?php

Route::group(['prefix' => 'sliders', 'as' => 'sliders.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'SliderController@index')->name('index');
    Route::get('create', 'SliderController@create')->name('create');
    Route::post('', 'SliderController@store')->name('store');
    Route::get('{id}/edit', 'SliderController@edit')->name('edit');
    Route::put('{id}', 'SliderController@update')->name('update');
    Route::delete('{id}', 'SliderController@destroy')->name('destroy');

    Route::post('upload', 'SliderController@upload')->name('upload');
});