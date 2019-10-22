<?php

use Illuminate\Http\Request;

 

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1'], function(){

	Route::get('cities', 'GeneralApiController@city');
	Route::get('regions', 'GeneralApiController@region');
	Route::get('clients', 'GeneralApiController@client');
	Route::get('categories', 'GeneralApiController@category');
	Route::get('restaurants', 'GeneralApiController@restaurant');
	Route::get('payment-methods', 'GeneralApiController@paymentMethods');
	Route::get('items', 'GeneralApiController@Item');
	Route::get('orders', 'GeneralApiController@Order');
	Route::get('item-orders', 'GeneralApiController@itemOrder');
	Route::get('item-offers', 'GeneralApiController@offers');
	Route::get('reviews', 'GeneralApiController@reviews');
	Route::get('contact-us', 'GeneralApiController@contactUs');
	Route::get('payments', 'GeneralApiController@payments');
	Route::get('settings', 'GeneralApiController@settings');

	Route::group(['prefix'=>'clients' , 'namespace'=>'Api\Clients'], function(){
		Route::post('register', 'ClientController@register');
		Route::post('login', 'ClientController@login');
		Route::post('reset-password', 'ClientController@resetPassword');	
		Route::post('new-password', 'ClientController@newPassword');
		Route::post('show-restaurant', 'AuthClientController@showRestaurants');
			Route::group(['middleware'=>'auth:client'], function(){
				Route::post('register-token', 'AuthClientController@registerToken');
				Route::post('remove-token', 'AuthClientController@removeToken');
				Route::post('new-order', 'AuthClientController@newOrder');
				Route::post('profile', 'AuthClientController@profile');
				Route::post('current-order', 'AuthClientController@myCurrentOrders');
				Route::post('previous-order', 'AuthClientController@myPreviousOrders');
				Route::post('add-review', 'AuthClientController@addReview');
				Route::post('declined-order', 'AuthClientController@declinedOrder');
				Route::post('delivered-order', 'AuthClientController@deliveredOrder');
				Route::post('restaurants', 'AuthClientController@restaurants');

			});	
	});

	Route::group(['prefix'=>'restaurants' , 'namespace'=>'Api\Restaurants'], function(){
		Route::post('register', 'RestaurantController@register');
		Route::post('login', 'RestaurantController@login');
		Route::post('reset-password', 'RestaurantController@resetPassword');	
		Route::post('new-password', 'RestaurantController@newPassword');

			Route::group(['middleware'=>'auth:restaurant'], function(){
				Route::post('register-token', 'AuthRestaurantController@registerToken');
				Route::post('remove-token', 'AuthRestaurantController@removeToken');
				Route::post('profile', 'AuthRestaurantController@profile');
				Route::post('new-offer', 'AuthRestaurantController@newOffer');
				Route::post('my-offer', 'AuthRestaurantController@myOffers');
				Route::post('delete-offer', 'AuthRestaurantController@deleteOffer');
				Route::post('update-offer', 'AuthRestaurantController@updateOffer');
				Route::post('new-item', 'AuthRestaurantController@newItem');
				Route::post('my-item', 'AuthRestaurantController@myItems');
				Route::post('update-item', 'AuthRestaurantController@updateItem');
				Route::post('delete-item', 'AuthRestaurantController@deleteItem');
				Route::post('accept-order', 'AuthRestaurantController@acceptOrder');
				Route::post('reject-order', 'AuthRestaurantController@rejectOrder');
				Route::post('confirm-order', 'AuthRestaurantController@confirmOrder');
				Route::post('new-order', 'AuthRestaurantController@newOrders');
				Route::post('current-order', 'AuthRestaurantController@currentOrders');
				Route::post('previous-order', 'AuthRestaurantController@previousOrders');
				Route::post('commission', 'AuthRestaurantController@commission');

			});	
	});
	

});


