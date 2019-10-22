<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\City;
use App\Region;

class CityController extends Controller
{
    public function index()
    {
    	$cities= City::paginate(2);
    	return view('admin.city.index', compact('cities'));
    }

    public function create()
    {
    	return view('admin.city.create');
    }

    public function store(Request $request)
    {
    	$validator = [
            'name'   =>'required',
        ]; 
        $input = $request->all();

        $validator = \Validator::make($input, $validator);
        City::create($input);

        flash()->success("added successfully");
        return redirect('admin/cities');
    }
//ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
    public function edit($id)
    {
        $city = city::findOrFail($id);
        return view('admin.city.edit', compact('city'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();


        $city = City::findOrFail($id);
        $city->update($input);

        flash()->success('Edited Successfully');
        return redirect(route('cities.index'));
    }
//ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ

    public function destroy($id)
    {
        $city = City::findOrFail($id);

        $region = Region::where('city_id', $city->id);
        $region->delete();

        $city->delete();

        flash()->success('Deleted Successfully');
        return redirect(route('cities.index'));
    }
}
