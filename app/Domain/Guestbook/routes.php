<?php

Route::group(['prefix' => 'guestbooks', 'as' => 'guestbooks.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'GuestbookController@index')->name('index');
    Route::get('create', 'GuestbookController@create')->name('create');
    Route::post('', 'GuestbookController@store')->name('store');
    Route::get('{id}/edit', 'GuestbookController@edit')->name('edit');
    Route::put('{id}', 'GuestbookController@update')->name('update');
    Route::delete('{id}', 'GuestbookController@destroy')->name('destroy');

});