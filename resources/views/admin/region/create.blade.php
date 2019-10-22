@extends('admin.index')
{{-- @inject('cities', 'App\City') --}}
@section('content')

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
		
	
    	{!! Form::open(['action' => 'Admin\RegionController@store']) !!}
	    	<div class="form-group">
	    		{!!Form::label('name', 'Name')!!}
	    		{!!Form::text('name', null, ['class'=>'form-control'])!!}
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
	    		<button class="btn btn-primary" type="submit">Add Region</button>
	    	</div>
		{!! Form::close() !!}
    </section>
</div>	
@endsection