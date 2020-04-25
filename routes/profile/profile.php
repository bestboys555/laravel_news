<?php
// profile //
Route::group(['prefix' => 'profile','as'=>'profile.'], function() {
    Route::get('data', ['as' => 'data', 'uses' => 'ProfileController@data']);
    Route::get('data_pass', ['as' => 'data_pass', 'uses' => 'ProfileController@data_pass']);
    Route::put('updateAuthUser', ['as' => 'updateAuthUser', 'uses' => 'ProfileController@updateAuthUser']);
    Route::put('UpdatePass', ['as' => 'UpdatePass', 'uses' => 'ProfileController@UpdatePass']);
    Route::post('Updatehidden_menu', ['as' => 'Updatehidden_menu', 'uses' => 'ProfileController@Updatehidden_menu']);
    Route::post('uploadAvatar', ['as' => 'uploadAvatar', 'uses' => 'ProfileController@uploadAvatar']);
});
