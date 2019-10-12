<?php
Route::group(['as'=>'admin.', 'prefix' => 'admin', 'namespace'=>'Admin','middleware' => 'role:manager'], function () {

    Route::resource('area', 'AreaController');
});