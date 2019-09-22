<?php

Route::group(['prefix' => 'gallery-images', 'as' => 'gallery_images.'], function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('gallery', '[0-9]+');

    Route::get('{gallery}', 'GalleryImageController@index')->name('index');
    Route::post('{gallery}', 'GalleryImageController@store')->name('store');
    Route::get('{id}/edit', 'GalleryImageController@edit')->name('edit');
    Route::put('{id}', 'GalleryImageController@update')->name('update');
    Route::delete('{id}', 'GalleryImageController@destroy')->name('destroy');

    Route::post('update-positions', 'GalleryImageController@updatePositions')->name('update_positions');
});