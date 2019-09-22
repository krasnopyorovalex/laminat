<?php

Route::group(['prefix' => 'articles', 'as' => 'articles.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'ArticleController@index')->name('index');
    Route::get('create', 'ArticleController@create')->name('create');
    Route::post('', 'ArticleController@store')->name('store');
    Route::get('{id}/edit', 'ArticleController@edit')->name('edit');
    Route::put('{id}', 'ArticleController@update')->name('update');
    Route::delete('{id}', 'ArticleController@destroy')->name('destroy');

});