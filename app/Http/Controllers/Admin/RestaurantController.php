<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Restaurant;
use App\City;
use App\Region;

class RestaurantController extends Controller
{
    public function index()
    {
    	$restaurants= Restaurant::paginate(2);
    	return view('admin.restaurant.index', compact('restaurants'));
    }

    
//ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ

    public function active($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->active = 1;
        $restaurant->save();
        flash()->success('تم التفعيل');
        return back();
    }

    public function deActive($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->active = 0;
        $restaurant->save();
        flash()->success('هذا العميل غير مفعل');
        return back();
    }
//ــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
    public function search(Request $request)
    {
        if($request->has('name')){
            $restaurants = Restaurant::where('name','like', '%'.  $request->name .'%')->paginate(4);
            return view('admin.restaurant.index', compact('restaurants'));           
        }
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        flash()->success('Deleted Successfully');
        return redirect(route('restaurant.index'));
    }
}
