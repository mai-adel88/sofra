<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;

class RoleController extends Controller
{
    public function index()
    {
        $records = Role::paginate(10);
        return view('admin.roles.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission_list' => 'required|array',

        ],[
            'name.required' => 'name is required',
            'permission_list.required' => 'permission list is required',

        ]);

        $records = Role::create($request->except('permission_list'));
        $records->permissions()->attach($request->permission_list);

        flash()->success("Role Added Successfully");
        return redirect('admin/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $records = Role::findOrFail($id);
        return view('admin/roles/edit', compact('records'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'name'           => 'required|unique:roles,name,'. $id,
            'display_name'   =>'required',
            'permission_list'=> 'required|array',

        ],[
            'name.required' => 'name is required',
            'permission_list.required' => 'permission list is required',

        ]);

        $records = Role::findOrFail($id);
        $records->update($request->except('permission_list'));

        $records->permissions()->sync($request->permission_list);

        flash()->success('Edited Successfully');
        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $records = Role::findOrFail($id);
        $records->delete();
        flash()->success('Deleted Successfully');
        return back();
    }
}
