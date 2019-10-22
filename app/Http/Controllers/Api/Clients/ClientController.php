<?php

namespace App\Http\Controllers\Api\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Client;
use App\Review;
use App\Restaurant;
use App\Settings;
use Auth;



class ClientController extends Controller
{
    public function register(Request $request)
    {
    	$validate = validator()->make($request->all(),[
    		'name'				=>	'required',
	    	'email'				=>	'required|unique:clients',
	    	'region_id'			=>	'required',
	    	'password'			=>	'required',
	    	'phone'				=>	'required',
    	]);
    	if($validate->fails()){
    		return apiResponse(0,$validate->errors());
    	}

    	$request->merge(['password'=>bcrypt($request->password)]);
    	$client = Client::create($request->all());
    	$client->api_token = str_random(60);
    	$client->save();

    	return apiResponse(1,'success', [
    		'client'	=>$client,
    		'api_token'	=>$client->api_token,
    	]);
    }

    public function login(Request $request)
    {
        $validate = validator()->make($request->all(), [
            'email'     =>'required',
            'password'  =>'required'
        ]);
        if($validate->fails()){
            return apiResponse(0, $validate->errors());
        }

        //validate
        $client = Restaurant::where('email', $request->email)->first();
        if($client){

            if(\Hash::make($request->password,[$client->password])){
                return apiResponse(1, 'done', [
                    'client'=>$client,
                    'api_token'=>$client->api_token
                ]);    
            }else{
                return apiResponse(0,'error in data');
            }
    
        }else{
            return apiResponse(0,'error in data');
        }
    }
    

    // reset password with email and send pin_code with mail
    public function resetPassword(Request $request)
    {
        $validate = validator()->make($request->all(), [
            'email' =>'required'
        ]);
        if($validate->fails()){return apiResponse(0, 'تأكد من البريد الالكتروني');}

        $user = Client::where('email', $request->email)->first();
        if($user){
            $code = rand(1111, 9999);
            $update = $user->update(['pin_code'=>$code]);

            if($update){
                //send email first we should do->php artisan make:mail ResetPassword --markdown=emails.auth.resetPassword

                \Mail::to($user->email)
                        ->bcc("maiadel799@gmail.com") //my email to be sure to send the message 
                        ->send(new ResetPassword($user));

                return apiResponse(1,  'برجاء فحص بريدك الالكتروني');
            }else{
                return apiResponse(0, 'حدث خطأ  حاول مر ه اخرى');
            }
        }

        return apiResponse(0, 'متمش');
   
    }

    public function newPassword(Request $request)
    {
        $validate = validator()->make($request->all(), [
            'email'     =>'required',
            'password'  =>'required',
            'pin_code'  =>'required'
        ]);
        if($validate->fails()){
            return apiResponse(1, $validate->errors());
        }

        $user = Client::where('pin_code', $request->pin_code)->where('pin_code', '!=', 0)
                      ->where('email', $request->email)->first();

        if($user){
            $user->password = bcrypt($request->password);

            if ($user->save()) {
                return apiResponse(1, "تم تغيير كلمة المرور بنجاح");
            }else{
                return apiResponse(0, "حدث خطأ , حاول مره اخرى");
            }

        }else{
            return apiResponse(0, "هذا الكود غير صالح");
        }    
    }
    //show open restaurants
    public function showRestaurants()
    {
        $activeRestaurants = Restaurant::active()->get(); //scop in model Restaurant
        return apiResponse(1, 'success', $activeRestaurants);
    }

    

    public function newOrderByGuest(Request $request)
    {
        $validate = validator()->make($request->all(), [
            'restaurant_id'     =>'required|exists:restaurants,id',
            'items .*. item_id' =>'required|exists:items,id',
            'items .*. quantity'=>'required',
            'address'           =>'required',
            'payment_method_id' =>'required',
        ]);

        if($validate->fails()){
            return apiResponse(0, $validate->errors());
        }

        $restaurant = Restaurant::find($request->restaurant_id);

        //check if it closed
        if($restaurant->status==0){ 
            return apiResponse(0,'هذا المطعم غير متوفر حاليا');
        }

        //if(Auth::guest()){
           // return apiResponse(0, 'يجب تسجيل الدخول اولا');
        //}
    }




    public function addReview(Request $request)
    {
        $review = Review::create($request->all());
        $review->save();
        return apiResponse(1, ['comment'=>$review->comment,
                               'rate'=>$review->raiting
        ]);
    }
}
