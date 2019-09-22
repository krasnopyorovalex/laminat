<?php

Route::group(['prefix' => 'images', 'as' => 'images.'], function () {
    Route::pattern('id', '[0-9]+');
    Route::put('{id}', 'ImageController@update')->name('update');
    Route::delete('{id}', 'ImageController@destroy')->name('destroy');
});