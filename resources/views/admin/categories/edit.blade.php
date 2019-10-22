@extends('admin.index')
 	

@section('content')

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h2>Edit category</h2>
	
    	{!! Form::model($category, ['action' => ['Admin\CategoryController@update', $category->id], 'method'=>'PUT'] ) !!}
	    	<div class="form-group">
	    		{!!Form::label('name', 'Name')!!}
	    		{!!Form::text('name', $category->name, ['class'=>'form-control'])!!}
	    	</div>

	    	

	    	<div class="form-group">
	    		<button class="btn btn-primary" type="submit">Edit</button>
	    	</div>
		{!! Form::close() !!}
    </section>
</div>	
@endsection