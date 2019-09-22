<?php

Route::group(['prefix' => 'menu-items', 'as' => 'menu_items.'], function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('menu', '[0-9]+');

    Route::get('{menu}', 'MenuItemController@index')->name('index');
    Route::get('create/{menu}', 'MenuItemController@create')->name('create');
    Route::post('', 'MenuItemController@store')->name('store');
    Route::get('{id}/edit', 'MenuItemController@edit')->name('edit');
    Route::put('{id}', 'MenuItemController@update')->name('update');
    Route::delete('{id}', 'MenuItemController@destroy')->name('destroy');

    Route::post('sorting/{parent}', 'MenuItemController@sorting')->name('sorting');

});