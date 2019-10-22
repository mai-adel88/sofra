@extends('admin.index')
@inject('role', 'App\Role')

@section('content')

<div class="content-wrapper">
<?php 
$roles = $role->pluck('display_name', 'id')->toArray();
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">

	
    	{!! Form::model($records, ['action' => ['Admin\UserController@update'
    					,$records->id], 'method'=>'PUT' ]) !!}
	    	<div class="form-group">
	    		<label for="name">الاسم</label>
	    		{!!Form::text('name', $records->name, ['class'=>'form-control'])!!}
	    	</div>
	    	<div class="form-group">
	    		<label for="name">الايميل</label>
	    		{!!Form::text('email', $records->email, ['class'=>'form-control'])!!}
	    	</div>

	    	<div class="form-group">
	    		<label for="roles_list">الرتب</label>
	    		{!!Form::select('roles_list[]', $roles, null,
	    		 ['class'=>'form-control',
	    		  'multiple' => 'multiple'	
	    		 ])!!}
	    	</div>

	    	<div class="form-group">
	    		<button class="btn btn-primary" type="submit">تحديث</button>
	    	</div>
		{!! Form::close() !!}
    </section>
</div>	
@endsection