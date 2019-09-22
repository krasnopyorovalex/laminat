<?php

Route::group(['prefix' => 'catalogs', 'as' => 'catalogs.'], static function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'CatalogController@index')->name('index');
    Route::get('create', 'CatalogController@create')->name('create');
    Route::post('', 'CatalogController@store')->name('store');
    Route::get('{id}/edit', 'CatalogController@edit')->name('edit');
    Route::put('{id}', 'CatalogController@update')->name('update');
    Route::delete('{id}', 'CatalogController@destroy')->name('destroy');

});
