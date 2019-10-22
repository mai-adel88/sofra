@extends('admin.index')
@inject('model', 'App\User')
@inject('role', 'App\Role')

@section('content')
<?php 
$roles = $role->pluck('display_name', 'id')->toArray();
?>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
    		
    	{!! Form::model($model, ['action' => 'Admin\UserController@store']) !!}
	    	<div class="form-group">
	    		<label for="name">Name</label>
	    		{!!Form::text('name', null, ['class'=>'form-control'])!!}
	    	</div>
	    	<div class="form-group">
	    		<label for="email">Email</label>
	    		{!!Form::text('email', null, ['class'=>'form-control'])!!}
	    	</div>
	    	<div class="form-group">
	    		<label for="password">Password</label>
	    		{!!Form::text('password', null, ['class'=>'form-control'])!!}
	    	</div>

	    	<div class="form-group">
	    		<label for="roles_list">Admin Roles</label>
	    		{!!Form::select('roles_list[]', $roles, null,
	    		 ['class'=>'form-control',
	    		  'multiple' => 'multiple'	
	    		 ])!!}
	    	</div>

	    	<div class="form-group">
	    		<button class="btn btn-primary" type="submit">Add</button>
	    	</div>
		{!! Form::close() !!}
    </section>
</div>	
@endsection