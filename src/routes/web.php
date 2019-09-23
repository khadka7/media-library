<?php

Route::group(['namespace'=>'Khadka7\MediaLibrary\Http\Controllers'], function () {
    Route::get('/medias/list','MediaController@index')->name('medias.list');
    Route::post('/media/create','MediaController@create')->name('media.create');
    Route::get('/media/add','MediaController@add')->name('media.add');
    Route::get('/media/{uuid}/delete','MediaController@delete')->name('media.delete');
    Route::get('/media/{uuid}/detail','MediaController@detail')->name('media.detail');
    Route::get('/media/{uuid}/info','MediaController@info')->name('media.info');
    Route::post('/media/{uuid}/update','MediaController@update')->name('media.update');
    Route::get('/ajax/medias','MediaController@media')->name('ajax.medias.list');
    Route::get('/ajax/medias/modal/gird-view','MediaController@gridView')->name('media.modal.grid');
    Route::get('/ajax/open-modal','MediaController@openModal')->name('media.modal.open');
    Route::get('/ajax/media/search','MediaController@searchMedia')->name('media.search');
    Route::get('/media/demo','MediaController@demo')->name('media.demo');
});
