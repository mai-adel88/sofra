@extends('admin.index')
@inject('model', 'App\City')
@section('content')

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
		
	
    	{!! Form::open(['action' => 'Admin\CityController@store']) !!}
	    	<div class="form-group">
	    		{!!Form::label('name', 'Name')!!}
	    		{!!Form::text('name', null, ['class'=>'form-control'])!!}
	    	</div>

	    	
	    	<div class="form-group">
	    		<button class="btn btn-primary" type="submit">Add City</button>
	    	</div>
		{!! Form::close() !!}
    </section>
</div>	
@endsection