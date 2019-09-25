<?php

Route::group(['prefix' => 'filter-options', 'as' => 'filter_options.'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('filter', '[0-9]+');

    Route::get('{filter}', 'FilterOptionController@index')->name('index');
    Route::get('create/{filter}', 'FilterOptionController@create')->name('create');
    Route::post('', 'FilterOptionController@store')->name('store');
    Route::get('{id}/edit', 'FilterOptionController@edit')->name('edit');
    Route::put('{id}', 'FilterOptionController@update')->name('update');
    Route::delete('{id}', 'FilterOptionController@destroy')->name('destroy');
});
