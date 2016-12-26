<?php

Route::group(['namespace' => 'Omnispear\Media\Controllers', 'middleware' => ['web']], function () {

    Route::group(['prefix' => 'media', 'as' => 'media.'], function () {
        Route::get('/{media}', [
            'as' => 'download', 'uses' => 'MediaController@download'
        ]);
        Route::get('/image/{media}', [
            'as' => 'image', 'uses' => 'MediaController@image'
        ]);
    });

    Route::group(['namespace' => 'Admin', 'middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::post('/media/upload', [
            'as' => 'media.upload', 'uses' => 'MediaController@upload'
        ]);
    });
});
