@extends('admin.index')
@inject('model', 'App\Role')
@inject('perm', 'App\Permission')

@section('content')

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">

	
    	{!! Form::model($model, ['action' => 'Admin\RoleController@store']) !!}
	    	<div class="form-group">
	    		<label for="name">Name</label>
	    		{!!Form::text('name', null, ['class'=>'form-control'])!!}
	    	</div>

	    	<div class="form-group">
	    		<label for="display_name">Dispaly Name</label>
	    		{!!Form::text('display_name', null, ['class'=>'form-control'])!!}
	    	</div>

	    	<div class="form-group">
	    		<label for="description">Description</label>
	    		{!!Form::textarea('description', null, ['class'=>'form-control'])!!}
	    	</div>

	    	<div class="form-group">
	    		<label for="permission_list">Permissions</label>
	    		<div class="row">
	    			@foreach($perm->all() as $permission)
	    			<div class="col-sm-3">
	    				<div class="checkbox">
	    					<label>
	    						<input type="checkbox" name="permission_list[]" value="{{$permission->id}}">{{$permission->display_name}}
	    					</label>
	    				</div>
	    			</div>
	    			@endforeach
	    		</div>
	    	</div>

	    	<div class="form-group">
	    		<button class="btn btn-primary" type="submit">Add</button>
	    	</div>
		{!! Form::close() !!}
    </section>
</div>	
@endsection