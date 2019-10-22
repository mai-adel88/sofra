<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Payment;
use App\Restaurant;

class PaymentController extends Controller
{
    public function index()
    {
    	$payments= Payment::paginate(2);
    	return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $restaurants = Restaurant::get();
    	return view('admin.payments.create', compact('restaurants'));
    }

    public function store(Request $request)
    {
    	$validator = [
            'paid'   =>'required',

        ]; 
        $input = $request->all();
        $validator = \Validator::make($input, $validator);

        $input['restaurant_id'] = $request->restaurant_id;
        Payment::create($input);

        flash()->success("added successfully");
        return redirect('admin/payments');
    }
//ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        return view('admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();


        $payment = Payment::findOrFail($id);
        $payment->update($input);

        flash()->success('Edited Successfully');
        return redirect(route('payments.index'));
    }
//ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ

    public function destroy($id)
    {
        $payments = Payment::findOrFail($id);

        $payments->delete();

        flash()->success('Deleted Successfully');
        return redirect(route('payments.index'));
    }
}
