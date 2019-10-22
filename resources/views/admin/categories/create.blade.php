@extends('admin.index')
@section('content')

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
		
	
    	{!! Form::open(['action' => 'Admin\CategoryController@store']) !!}
	    	<div class="form-group">
	    		{!!Form::label('name', 'Category Name')!!}
	    		{!!Form::text('name', null, ['class'=>'form-control'])!!}
	    	</div>

	    	
	    	<div class="form-group">
	    		<button class="btn btn-primary" type="submit">Add</button>
	    	</div>
		{!! Form::close() !!}
    </section>
</div>	
@endsection