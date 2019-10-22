@extends('admin.index')
@section('content')

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h2>Edit Region</h2>
	
    	{!! Form::model($region, ['action' => ['Admin\RegionController@update', $region->id], 'method'=>'PUT'] ) !!}
	    	<div class="form-group">
	    		{!!Form::label('name', 'Name')!!}
	    		{!!Form::text('name', $region->name, ['class'=>'form-control'])!!}
	    	</div>

	    	<div class="form-group">
	    		{!!Form::label('city_id', 'City')!!}
	    		<select  name="city_id" class="form-control">
    			@foreach($cities as $city)
    				<option value="{{$city->id}}">{{$city->name}}</option>
    			@endforeach	    			
	    		</select>
	    	</div>

	    	

	    	<div class="form-group">
	    		<button class="btn btn-primary" type="submit">Edit</button>
	    	</div>
		{!! Form::close() !!}
    </section>
</div>
@endsection