<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\ContactUs;


class ContactController extends Controller
{
    public function index()
    {
    	$contacts= ContactUs::paginate(3);
    	return view('admin.contacts.index', compact('contacts'));
    }

//ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ

    public function destroy($id)
    {
        $contacts = ContactUs::findOrFail($id);

        $contacts->delete();

        flash()->success('تم الحذف بنجاح');
        return redirect(route('contacts.index'));
    }
}
