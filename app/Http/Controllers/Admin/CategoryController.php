<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;


class CategoryController extends Controller
{
    public function index()
    {
    	$categories= Category::paginate(2);
    	return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
    	return view('admin.categories.create');
    }

    public function store(Request $request)
    {
    	$validator = [
            'name'   =>'required',
        ]; 
        $input = $request->all();

        $validator = \Validator::make($input, $validator);
        Category::create($input);

        flash()->success("added successfully");
        return redirect('admin/categories');
    }
//ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();


        $category = Category::findOrFail($id);
        $category->update($input);

        flash()->success('Edited Successfully');
        return redirect(route('categories.index'));
    }
//ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        flash()->success('Deleted Successfully');
        return redirect(route('categories.index'));
    }
}
