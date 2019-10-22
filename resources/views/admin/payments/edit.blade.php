@extends('admin.index')
@inject('restaurants', 'App\Restaurant')	

@section('content')

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h2>تعديل</h2>
	
    	{!! Form::model($payment, ['action' => ['Admin\PaymentController@update', $payment->id], 'method'=>'PUT'] ) !!}
	    	<div class="form-group">
	    		{!!Form::select('restaurant_id', $restaurants->pluck('name', 'id')->toArray(),null,[
	    					'class'=>'form-control', 'placeholder'=>'اختر اسم المطعم'
	    			])!!}
	    	</div>
	    	
	    	<div class="form-group">
	    		{!!Form::text('paid', $payment->paid, ['class'=>'form-control', 'placeholder'=>'المبلغ المدفوع'])!!}
	    	</div>

	    	<div class="form-group">
	    		{!!Form::textarea('note', $payment->note, ['class'=>'form-control', 'placeholder'=>'ملاحظات'])!!}
	    	</div>

	    	

	    	<div class="form-group">
	    		<button class="btn btn-primary" type="submit">تعديل</button>
	    	</div>
		{!! Form::close() !!}
    </section>
</div>	
@endsection