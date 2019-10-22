<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\City;
use App\Region;

class RegionController extends Controller
{
    public function index()
    {
    	$regions= Region::paginate(2);
    	return view('admin.region.index', compact('regions'));
    }

    public function create()
    {
        $cities = City::get();
    	return view('admin.region.create', compact('cities'));
    }

    public function store(Request $request)
    {
    	$validator = [
            'name'   =>'required',
        ]; 
        $input = $request->all();

        $validator = \Validator::make($input, $validator);
        Region::create($input);

        flash()->success("added successfully");
        return redirect('admin/regions');
    }
//ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
    public function edit($id)
    {
        $region = Region::findOrFail($id);
        $cities = City::get();
        return view('admin.region.edit', compact('region', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();


        $region = Region::findOrFail($id);
        $region->update($input);

        flash()->success('Edited Successfully');
        return redirect(route('regions.index'));
    }
//ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ

    public function destroy($id)
    {
        $region = Region::findOrFail($id);
        $region->delete();

        flash()->success('Deleted Successfully');
        return redirect(route('regions.index'));
    }
}
