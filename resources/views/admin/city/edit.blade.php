@extends('admin.index')
 	

@section('content')

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h2>Edit City</h2>
	
    	{!! Form::model($city, ['action' => ['Admin\CityController@update', $city->id], 'method'=>'PUT'] ) !!}
	    	<div class="form-group">
	    		{!!Form::label('name', 'Name')!!}
	    		{!!Form::text('name', $city->name, ['class'=>'form-control'])!!}
	    	</div>

	    	

	    	<div class="form-group">
	    		<button class="btn btn-primary" type="submit">Edit</button>
	    	</div>
		{!! Form::close() !!}
    </section>
</div>	
@endsection