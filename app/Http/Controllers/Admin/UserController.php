<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        //permissions
        

        $records = User::paginate(10);
        return view('admin.users.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.users.create');
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
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required',

        ],[
            'name.required'     => 'name is required',
            'email.required'    => 'email is required',
            'email.required'    => 'email is already exists',
            'password.required' => 'password is required',

        ]);

        $request->merge(['password'=>bcrypt($request->password)]);
        $records = User::create($request->except('roles_list', 'permission_list'));
        //$records = new User;
        //$records->name = $request->name;
        //$records->email = $request->email;
        //$records->password = bcrypt($request->password);
        
        $records->roles()->attach($request->input('roles_list'));
         
        $records->save();

        flash()->success("added successfully");
        return redirect('admin/users');
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
        $records = User::findOrFail($id);
        return view('admin/users/edit', compact('records'));
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
        $records = User::findOrFail($id);
        if($request->input('password')){
            $request->merge(['password'=>bcrypt($request->password)]);
        }
        $records->update($request->except('roles_list','permission_list'));
        $records->roles()->sync($request->input('roles_list','permission_list'));
        
        flash()->success('Edited Successfully');
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $records = User::findOrFail($id);
        $records->delete();
        flash()->success('Deleted Successfully');
        return back();
    }

    public function changePassword()
    {
        return view('admin.users.change-password');
    }

    public function changePasswordSave(Request $request)
    {
        $this->validate($request, [
            'old-password' => 'required',
            'password'      => 'required',

        ],[
            'old-password.required' => 'current password is required',
            'password.required'     => 'new password is required',

        ]);

        $user = auth()->user();
        if(\Hash::check($request->input('old-password'), $user->password)){
            $user->password = bcrypt($request->input('password'));
            $user->save();

            flash()->success('تم تغيير كلمة المرور بنجاح');
            return redirect(url(route('users.index')));
        }else{
            flash()->error('كلمة المرور غي صحيحه');
            return redirect(url(route('users.index')));
            
        }
    }
}
