<?php

Auth::routes();
Route::group(['middleware'=>['auth','auto-check-permission'], 'prefix'=>'admin', 'namespace'=>'Admin'],function(){
	Route::view('home', 'admin.home');
	Route::resource('restaurant', 'RestaurantController');
	Route::get('restaurants/{id}/deActive','RestaurantController@deActive');
	Route::get('restaurants/{id}/active','RestaurantController@active');
	Route::post('restaurant/search', 'RestaurantController@search');
	Route::resource('cities', 'CityController');
	Route::resource('regions', 'RegionController');
	Route::resource('categories', 'CategoryController');
	Route::resource('payments', 'PaymentController');
	Route::resource('offers', 'OfferController');
	Route::resource('contacts', 'ContactController');
	Route::resource('clients', 'ClientController');
	Route::get('clients/{id}/deActive','ClientController@deActive');
	Route::get('clients/{id}/active','ClientController@active');
	Route::resource('orders', 'OrderController');
	Route::resource('users', 'UserController');
	Route::get('change-password', 'UserController@changePassword');
	Route::post('change-password', 'UserController@changePasswordSave');
	Route::resource('roles', 'RoleController');


});

Route::get('/home', 'HomeController@index')->name('home');
