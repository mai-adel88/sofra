<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\City;
use App\Region;
use App\Client;
use App\Category;
use App\Restaurant;
use App\PaymentMethod;
use App\Item;
use App\Order;
use App\ItemOrder;
use App\ItemOffer;
use App\Review;
use App\ContactUs;
use App\Payment;
use App\Settings;


class GeneralApiController extends Controller
{
    public function city()
    {
    	$data = City::paginate(3);
    	return apiResponse(1,'تم بنجاح', $data);
    }
 
    public function region()
    {
    	$data = Region::paginate(3);
    	return apiResponse(1,'تم بنجاح', $data);
    }

    public function client(Request $request)
    {
    	$data = Client::paginate(3);
    	return apiResponse(1,'تم بنجاح', ['data'=>$data, 'api_token'=>$request->api_token]);
    }

    public function category()
    {
    	$data = Category::paginate(3);
    	return apiResponse(1,'تم بنجاح', $data);
    }

    public function restaurant()
    {
    	$data = Restaurant::paginate(3);
    	return apiResponse(1,'تم بنجاح', $data);
    }

    public function paymentMethods()
    {
        $data = PaymentMethod::paginate(3);
        return apiResponse(1,'تم بنجاح', $data);
    }

    public function item()
    {
        $data = Item::paginate(3);
        return apiResponse(1,'تم بنجاح', $data);
    }

    public function order()
    {
        $data = Order::paginate(3);
        return apiResponse(1,'تم بنجاح', $data);
    }

    public function itemOrder()
    {
        $data = ItemOrder::paginate(3);
        return apiResponse(1,'تم بنجاح', $data);
    }

    public function offers()
    {
        $data = ItemOffer::paginate(3);
        return apiResponse(1,'تم بنجاح', $data);
    }

    public function reviews()
    {
        $data = Review::paginate(3);
        return apiResponse(1,'تم بنجاح', $data);
    }

    public function contactUs()
    {
        $validator = validator()->make($request->all(), [
            'full_name' =>'required',
            'email'     =>'required',
            'phone'     =>'required',
            'subject'   =>'required',
        ]);

        if($validator->fails()){
            return apiResponse(1, $validator->errors());
        }

        $data = ContactUs::paginate(3);
        return apiResponse(1,'تم بنجاح', $data);
    }

    public function payments()
    {
        $data = Payment::paginate(3);
        return apiResponse(1,'تم بنجاح', $data);
    }

    public function settings()
    {
        $data = Settings::paginate(3);
        return apiResponse(1,'تم بنجاح', $data);
    }

    
}
