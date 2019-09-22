<?php

Route::group(['prefix' => 'catalog-products', 'as' => 'catalog_products.'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('catalog', '[0-9]+');

    Route::get('{catalog}', 'CatalogProductController@index')->name('index');
    Route::get('create/{catalog}', 'CatalogProductController@create')->name('create');
    Route::post('', 'CatalogProductController@store')->name('store');
    Route::get('{id}/edit', 'CatalogProductController@edit')->name('edit');
    Route::put('{id}', 'CatalogProductController@update')->name('update');
    Route::delete('{id}', 'CatalogProductController@destroy')->name('destroy');

});
