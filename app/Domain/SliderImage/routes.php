<?php

Route::group(['prefix' => 'slider-images', 'as' => 'slider_images.'], function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('slider', '[0-9]+');

    Route::get('{slider}', 'SliderImageController@index')->name('index');
    Route::post('{slider}', 'SliderImageController@store')->name('store');
    Route::get('{id}/edit', 'SliderImageController@edit')->name('edit');
    Route::put('{id}', 'SliderImageController@update')->name('update');
    Route::delete('{id}', 'SliderImageController@destroy')->name('destroy');

    Route::post('update-positions', 'SliderImageController@updatePositions')->name('update_positions');
});