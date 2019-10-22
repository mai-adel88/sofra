@extends('admin.index')
@inject('restaurants', 'App\Restaurant')
@section('content')

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h2>اضافة عمليه ماليه</h2>
	
    	{!! Form::open(['action' => 'Admin\PaymentController@store']) !!}
	    	<div class="form-group">
	    		{!!Form::select('restaurant_id', $restaurants->pluck('name', 'id')->toArray(),null,[
	    					'class'=>'form-control', 'placeholder'=>'اختر اسم المطعم'
	    			])!!}
	    	</div>
	    	
	    	<div class="form-group">
	    		{!!Form::text('paid', null, ['class'=>'form-control', 'placeholder'=>'المبلغ المدفوع'])!!}
	    	</div>

	    	<div class="form-group">
	    		{!!Form::textarea('note', null, ['class'=>'form-control', 'placeholder'=>'ملاحظات'])!!}
	    	</div>

	    	
	    	<div class="form-group">
	    		<button class="btn btn-primary" type="submit">اضافه</button>
	    	</div>
		{!! Form::close() !!}
    </section>
</div>	
@endsection