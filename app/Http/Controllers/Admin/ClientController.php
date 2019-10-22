<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Client;
use App\City;
use App\Region;

class ClientController extends Controller
{
    public function index()
    {
    	$clients= Client::paginate(2);       
    	return view('admin.clients.index', compact('clients'));
    }

    
//ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ

    public function active($id)
    {
        $client = Client::findOrFail($id);
        $client->active = 1;
        $client->save();
        flash()->success('تم التفعيل');
        return back();
    }

    public function deActive($id)
    {
        $client = Client::findOrFail($id);
        $client->active = 0;
        $client->save();
        flash()->success('هذا العميل غير مفعل');
        return back();
    }

//ــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        flash()->success('Deleted Successfully');
        return redirect(route('client.index'));
    }
}
