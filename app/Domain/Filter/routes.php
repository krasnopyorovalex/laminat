<?php

Route::group(['prefix' => 'filters', 'as' => 'filters.'], static function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'FilterController@index')->name('index');
    Route::get('create', 'FilterController@create')->name('create');
    Route::post('', 'FilterController@store')->name('store');
    Route::get('{id}/edit', 'FilterController@edit')->name('edit');
    Route::put('{id}', 'FilterController@update')->name('update');
    Route::delete('{id}', 'FilterController@destroy')->name('destroy');
});
