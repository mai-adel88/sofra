<?php

namespace App\Http\Controllers\Api\Restaurants;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Restaurant;
use App\Review;
use App\ItemOffer;
use App\Token;
use App\Item;
use App\Client;


class AuthRestaurantController extends Controller
{
    //edit profile
    public function profile(Request $request)
    {
        $res = Restaurant::find($request->id);
        $validate = validator()->make($request->all(), [
            'password'       => 'confirm',
            //'image'          => 'image',
            
        ]);
        if($validate->fails()){
            return apiResponse(1, $validate->errors());
        }

        $loginRestaurant = $request->user();

        if($request->has('password')){
            $request->merge(['password'=>bcrypt($request->password)]);
        }
        $update = $loginRestaurant->update($request->all());

        return apiResponse(1, 'تم تعديل البيانات بنجاح', $update);
    }

    //add new item
    public function newItem(Request $request)
    {
        
        $validate = validator()->make($request->all(), [
            'name'               =>'required',
            'description'        =>'required',
            'price'              =>'required',
            'time_of_preparation'=>'required|date_format:H:i',
            'offer_price'        =>'required',
            'image'              =>'required|image',
            'restaurant_id'      =>'required|exists:restaurants,id',
        ]);

        if($validate->fails()){
            return apiResponse(0, $validate->errors());
        }

        $item = Item::create($request->except('image'));

        if ($request->hasFile('image')) {
                $path = public_path();
                $destinationPath = $path . '/images/restaurants/items'; // upload path
                $logo = $request->file('image');
                $extension = $logo->getClientOriginalExtension(); // getting image extension
                $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
                $logo->move($destinationPath, $name); // uploading file to given path
                $request->user()->update(['image' => 'images/restaurants/items' . $name]);
        }

        return apiResponse(1, 'success', 'تم اضافة عنصر جديد');

    }

    public function myItems(Request $request)
    {
        $myItems = $request->user()->items()->paginate(1);
        return apiResponse(1, 'تم التحميل', $myItems);
    }

    //edit item
    public function updateItem(Request $request)
    {
        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";

        $validate = validator()->make($request->all(),[
            
            'price'              =>array('regex:'.$regex),
            'time_of_preparation'=>'date_format:H:i',
            'offer_price'        =>array('regex:'.$regex),
            'image'              =>'image',
            'restaurant_id'      =>'exists:restaurants,id', 
        ]);
        if($validate->fails()){
            return apiResponse(0, $validate->errors());
        }

        $item = $request->user()->items()->find($request->item_id);
        
        if($item){
            $item->update($request->except('image'));
            if ($request->hasFile('image')) {
                $path = public_path();
                $destinationPath = $path . '/images/restaurants/items'; // upload path
                $logo = $request->file('image');
                $extension = $logo->getClientOriginalExtension(); // getting image extension
                $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
                $logo->move($destinationPath, $name); // uploading file to given path
                $request->user()->items()->update(['image' => 'images/restaurants/items' . $name]);
            }

            return apiResponse(1, 'تم تحديث البيانات بنجاح');
        }else{
            return apiResponse(1, 'هذا العنصر غير موجود');
        }
        
    }

    public function deleteItem(Request $request)
    {
        $item = $request->user()->items()->find($request->item_id)->delete();
        return apiResponse(0, 'تم حذف العنصر بنجاح ');
    }

    //show restaurant's offers
    public function myOffers(Request $request)
    {
        $myOffers = $request->user()->offers()->paginate(2);
        return apiResponse(1, 'تم  التحميل ', $myOffers);
    }

    //create new offer
    public function newOffer(Request $request)
    {

        $validate = validator()->make($request->all(), [
            'image'               =>'image',
            'product_offer_name'  =>'required',
            'description'         =>'required',
            'from'                =>'required|date_format:Y-m-d H:i:s',
            'to'                  =>'required|date_format:Y-m-d H:i:s',
            'restaurant_id'       =>'required|exists:restaurants,id'  
        ]);
        if($validate->fails()){
            return apiResponse(0, $validate->errors());
        }

        
        $offer = ItemOffer::create($request->except('image'));
        if ($request->hasFile('image')) {
                $path = public_path();
                $destinationPath = $path . '/images/restaurants/'; // upload path
                $logo = $request->file('image');
                $extension = $logo->getClientOriginalExtension(); // getting image extension
                $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
                $logo->move($destinationPath, $name); // uploading file to given path
                $request->user()->update(['image' => 'images/restaurants/' . $name]);
            }

        return apiResponse(1, 'success', [
            'offer' =>$offer
        ]);
    }

    //update offer
    public function updateOffer(Request $request)
    {
        $input = $request->all();
        $validate = validator()->make($input, [
            'image'               =>'image',
            'from'                =>'date_format:Y-m-d H:i:s',
            'to'                  =>'date_format:Y-m-d H:i:s',
            'restaurant_id'       =>'exists:restaurants,id',  
        ]);
        if($validate->fails()){
            return apiResponse(0, $validate->errors());
        }
        
        $offer = $request->user()->offers()->find($request->offer_id);

        if($offer){
            $offer->update($request->except('image'));

            if ($request->hasFile('image')) {
                $path = public_path();
                $destinationPath = $path . '/images/restaurants/'; // upload path
                $logo = $request->file('image');
                $extension = $logo->getClientOriginalExtension(); // getting image extension
                $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
                $logo->move($destinationPath, $name); // uploading file to given path
                $request->user()->update(['image' => 'images/restaurants/' . $name]);
            }
            return apiResponse(1, 'تم تحديث البيانات بنجاح');

        }else{
            return apiResponse(0, 'هذا العرض غير موجود');            
        }
    }

    //delete my offer
    public function deleteOffer(Request $request)
    {
        $myOffers = $request->user()->offers()->where('id', $request->id)->delete();
        
        return apiResponse(1, 'تم الحذف بنجاح ');
    }
//ــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
    //upload image 
    public function upload()
    {
        $extension = $file->getClientOriginalExtension(); //2
        $sha1 = sha1($file->getClientOriginalName()); //hash name of file //3
        $filename = date('Y-m-d-h-i-s').".".$sha1.".".$extension; //finally name
        $path = public_path('images/Offersimg/');
        $file->move($path, $filename); //step 1

        return 'images/Offersimg/'.$filename;
    }

    //accept order and send notification to the client
    public function acceptOrder(Request $request)
    {
        $order = $request->user()->orders()->find($request->order_id);
        if(!$order){ return apiResponse(0, 'هذا الطلب غير موجود'); }

        if($order->state=='accepted'){ return apiResponse(1, 'تم قبول الطلب'); }

        $order->update(['state'=>'accepted']);

        $client = Client::find($request->client_id);

        //send notification to client for the accepted order
        $client->notifications()->create([
            'title' =>'تم قبول الطلب',
            'content'=>'تم قبول الرطلب رقم'.$request->order_id,
            'order_id'=>$order->id
        ]);

        $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();

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
    }

    //reject order and send notification to the client
    public function rejectOrder(Request $request)
    {
        $order = $request->user()->orders()->find($request->order_id);
        if(!$order){ return apiResponse(0, 'هذا الطلب غير موجود'); }

        if($order->state=='rejected'){ return apiResponse(1, 'تم رفض الطلب'); }

        $order->update(['state'=>'rejected']);

        $client = Client::find($request->client_id);

        //send notification to client for the rejected order
        $client->notifications()->create([
            'title' =>'تم رفض طلبك',
            'content'=>'تم رفض الطلب  رقم'.$request->order_id,
            'order_id'=>$order->id
        ]);

        $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();

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
    }

    //confirm order and send notification to the client
    public function confirmOrder(Request $request)
    {
        $order = $request->user()->orders()->find($request->order_id);
        if(!$order){ return apiResponse(0, 'هذا الطلب غير موجود'); }

        if($order->state!='accepted'){ return apiResponse(1, 'لا يمكن تأكيد طلبك , الطلب غير مقبول'); }

        $order->update(['state'=>'delivered']);

        $client = Client::find($request->client_id);

        //send notification to client for the rejected order
        $client->notifications()->create([
            'title' =>'تم تأكدي  وصول طلبك',
            'content'=>'تم تأكيد توصيل طلبك رقم '.$request->order_id,
            'order_id'=>$order->id
        ]);

        $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();

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
    }

    public function newOrders(Request $request) //pending 
    {
        $orders = $request->user()->orders()->where('state', '=', 'pending')->paginate(1);
        return apiResponse(1,'تم تحميل الطلبات الجديده', $orders);
    }

    public function currentOrders(Request $request) //accepted 
    {
        $orders = $request->user()->orders()->where('state', '=', 'accepted')->paginate(1);
        return apiResponse(1,'تم تحميل الطلبات الحاليه', $orders);
    }

    public function previousOrders(Request $request) //rejected|delivered|decliened 
    {
        $orders = $request->user()->orders()->whereIn('state', ['rejected','delivered','decliened'])->paginate(1);
        return apiResponse(1,'تم تحميل الطلبات السابقه', $orders);
    }

    public function commission(Request $request) //orders must be delivered
    {
        $order = $request->user()->orders()->where('state','=','delivered');

        if($order){
            $commisions = $order->sum('commission');
            $total = $order->sum('total');
            $paid  =  $request->user()->payments()->sum('paid');
            $remaining = $commisions - $paid;

            return apiResponse(1, 'العمولات', [
            'total'     =>['مبيعات المطعم '=>$total ],
            'commisions'=>$commisions,
            'paid'      =>$paid,
            'remaining' =>$remaining
        ]);
        }else{
            return apiResponse(0, 'ليس هناك طلبات مستلمه ');
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
