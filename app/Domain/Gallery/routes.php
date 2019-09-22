<?php

Route::group(['prefix' => 'galleries', 'as' => 'galleries.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'GalleryController@index')->name('index');
    Route::get('create', 'GalleryController@create')->name('create');
    Route::post('', 'GalleryController@store')->name('store');
    Route::get('{id}/edit', 'GalleryController@edit')->name('edit');
    Route::put('{id}', 'GalleryController@update')->name('update');
    Route::delete('{id}', 'GalleryController@destroy')->name('destroy');

    Route::post('upload', 'GalleryController@upload')->name('upload');
});