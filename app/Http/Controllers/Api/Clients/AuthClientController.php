<?php

namespace App\Http\Controllers\Api\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Client;
use App\Review;
use App\Restaurant;
use App\Item;
use App\Settings;
use App\Token;
use Auth;
 


class AuthClientController extends Controller
{
    //edit profile
    public function profile(Request $request)
    {
        $validate = validator()->make($request->all(), [
            'email'     =>'email',
            'region_id' =>'exists:regions,id',
            
        ]);
        if($validate->fails()){
            return apiResponse(1, $validate->errors());
        }

        $loginClient = $request->user();

        $update = $loginClient->update($request->all());

        return apiResponse(1, 'تم تعديل البيانات بنجاح', $update);
    }

    public function restaurants(Request $request) //city , restaurant name
    {
        $restaurant = Restaurant::where(function($q) use($request){
            if($request->has('city_id')){
                $q->whereHas('region',function($region) use($request) {
                    $region->where('city_id', $request->city_id);
                });
            }

            if($request->has('name')){  
                $q->where('name', $request->name);
            }
            
        })->paginate(2);

        return apiResponse(1, 'تم تحميل المطاعم', $restaurant);
    }
   
    //create new order and send notification to restaurant
    public function newOrder(Request $request)
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


        $order  = $request->user()->orders()->create([
            'restaurant_id' =>$request->restaurant_id,
            'note'          =>$request->note,
            'state'         =>'pending',
            'address'       =>$request->address,
            'payment_method_id'=>$request->payment_method_id
        ]);


        $cost = 0;
        $delivery_fee =$request->delivery_fee;

        foreach ($request->items as $i) {
            //[item_id=2 quantity=1 note=spicy]
            $item = Item::find($i['item_id']);

            $readyItem  =[
                $i['item_id']=>[  //pivot
                    'quantity'   =>$i['quantity'],
                    'total_price'=>$item->price,
                    'note'       =>(isset($i['note']))?$i['note']:''
                ]
            ];
            
            //$order->items()->attach();//M:M attach item_id with order but not have pivots
            $order->items()->attach($readyItem); // attach in case of pivots exist 
                                                //attach( id=>['pivot1'=> , 'pivot2'=> ]);
        
            $cost +=($item->price * $i['quantity']);

            
            //mini charge
            if($cost>= $request->mini_charge){
                $total = $cost + $delivery_fee;

                $commission = settings()->commission * $cost; //assume 0.1 if it 10% (percentage)should devide /100
                $net = $total - settings()->commission;

                $update = $order->update([
                    'cost'        =>$cost,
                    'delivery_fee'=>$delivery_fee,
                    'total'       =>$total,
                    'commission'  =>$commission,
                    'net'         =>$net
                ]);

                //send notification to restaurant for new order
                $restaurant->notifications()->create([
                    'title' =>'لديك طلب جديد',
                    'content'=>'طلب جديد من العميل '.$request->user()->name,
                    'order_id'=>$order->id
                ]);

                $tokens = $restaurant->tokens()->where('token', '!=', '')->pluck('token')->toArray();

                //by fire base
                $send = null;
                if(count($tokens)){
                    $title='Sofra';
                    $body =$notifications->content;
                    $data = [
                    'order'=>$order->fresh()->load('items')//load(lazy eager loading)like ->with('items')
                    ];
                    $send = notifyByFirebase($title,$body, $tokens, $data);
                    info('Firebase result:' . $send);
                }
                return apiResponse(1, 'تم الطلب بنجاح' , $send);
            
            }else{
                $order->items()->delete();
                $order->delete();
                return apiResponse(0, 'الطلب لايمكن ان يكون اقل من '.$request->mini_charge.'جنيها');
            }
        }
        
    }

    public function declinedOrder(Request $request) //decline order should be accepted 
    {
        $order  = $request->user()->orders()->find($request->order_id);
        if(!$order){return apiResponse(0,'هذا الطلب غير موجود');}
        if($order->state == 'accepted'){
            $order->update(['state'=>'declined']);    
        }else{
            return apiResponse(0,'لم يتم قبول  هذا الطلب');
        }
        
        return apiResponse(0, 'تم رفض الطلب');
    }

    public function deliveredOrder(Request $request) //delivered order should be accepted 
    {
        $order  = $request->user()->orders()->find($request->order_id);
        if(!$order){return apiResponse(0,'هذا الطلب غير موجود');}
        if($order->state == 'accepted'){
            $order->update(['state'=>'delivered']);    
        }else{
            return apiResponse(0,'لم يتم قبول  هذا الطلب');
        }
        
        return apiResponse(0, 'تم استلام الطلب');
    }


    public function myCurrentOrders(Request $request) //pending 
    {
        $orders = $request->user()->orders()->where('state', '=', 'pending')->paginate(1);
        return apiResponse(1,'تم  تحميل الطلبات الحالي', $orders);
    }

    public function myPreviousOrders(Request $request) //!=pending 
    {
        $orders = $request->user()->orders()->where('state', '!=', 'pending')->paginate(1);
        return apiResponse(1,'تم  تحميل الطلبات الحالي', $orders);
    }

    //add review
    public function addReview(Request $request)
    {
        $validate = validator()->make($request->all(), [
            'comment'   =>'min:3',
            'rating'    =>'required|in:1, 2, 3, 4, 5',
            'restaurant_id'=>'required|exists:restaurants,id'
        ]);

        if($validate->fails())
        {
            return apiResponse(0, $validate->errors());
        }
        if($request->user()->orders()->count()>0){

            $review = Review::create([
                'comment'      =>$request->comment,
                'rating'       =>$request->rating,
                'restaurant_id'=>$request->restaurant_id,
                'client_id'    =>$request->user()->id,
            ]);
            $review->save();
            return apiResponse(1, 'التقييم ', $review);
        }else{
            return apiResponse(0, 'لا يمكن التقييم  بسبب عدم شراء من هذا المطعم من قبل');
        }
    }

    //trying to associate user with the device -create token/ remove- to send notifications
    public function registerToken(Request $request)  
    {
        $validator = validator()->make($request->all(), [
                'token'  =>  'required',
                'type'   =>  'required|in:android,ios',
        ]);
        if($validator->fails())
        {
            return apiResponse(0, $validator->errors());
        }

        Token::where('token', $request->token)->delete();//if two person open the app from the same device -> not to have the same token
        $request->user()->tokens()->create($request->all()); //create new token for this device
        return apiResponse(1, 'تم التسجيل بنجاح ');

    }

    public function removeToken(Request $request) //if the moblie made sign out from the app, remove its token
    {
         $validator = validator()->make($request->all(), [
                'token'  =>  'required',
                
        ]);
        if($validator->fails())
        {
            return apiResponse(0, $validator->errors());
        }

        Token::where('token', $request->token)->delete();

        return apiResponse(1, 'تم الحذف بنجاح');
    }
}
