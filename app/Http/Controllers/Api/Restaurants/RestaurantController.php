<?php

namespace App\Http\Controllers\Api\Restaurants;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Restaurant;
use App\Category;

class RestaurantController extends Controller 
{
    public function register(Request $request)
    {
    	$validate = validator()->make($request->all(),[
    		'name'			 =>	'required',
	    	'email'			 =>	'required|unique:clients',
	    	'region_id'		 =>	'required|exists:regions,id',
	    	'password'		 =>	'required',
	    	'phone'			 =>	'required',
            'mini_charge'    => 'required',
            'delivery_fee'   => 'required',
            'phone_delivery' => 'required',
            'whatsapp'       => 'required',
            'image'          => 'required',
            'status'         => 'required',
            'category.*'     => 'required|exists:categories,id'
    	]);
    	if($validate->fails()){
    		return apiResponse(0,$validate->errors());
    	}

    	$request->merge(['password'=>bcrypt($request->password)]);
    	$restaurant = Restaurant::create($request->all());

        for($i=0; $i<count($request->category); $i++){
            $ca = $request->category;
            $category = Category::find($ca[$i]); //category[0]
 
            $restaurant->categories()->attach($category->id);    
        }
        
    	$restaurant->api_token = str_random(60);
    	$restaurant->save();

    	return apiResponse(1,'success', [
    		'restaurant'=>$restaurant,
    		'api_token'	=>$restaurant->api_token,
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
        $restaurant = Restaurant::where('email', $request->email)->first();
        if($restaurant){

            if(\Hash::make($request->password,[$restaurant->password])){
                return apiResponse(1, 'done', [
                    'restaurant'=>$restaurant,
                    'api_token'=>$restaurant->api_token
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

        $user = Restaurant::where('email', $request->email)->first();
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

        $user = Restaurant::where('pin_code', $request->pin_code)->where('pin_code', '!=', 0)
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
    


}
