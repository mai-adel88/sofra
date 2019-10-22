<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\ItemOffer;


class OfferController extends Controller
{
    public function index()
    {
    	$offers= ItemOffer::paginate(3);
        $date_now = Carbon::now();
    	return view('admin.offers.index', compact('offers', 'date_now'));
    }

//ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ

    public function destroy($id)
    {
        $offers = ItemOffer::findOrFail($id);

        $offers->delete();

        flash()->success('تم الحذف بنجاح');
        return redirect(route('offers.index'));
    }
}
