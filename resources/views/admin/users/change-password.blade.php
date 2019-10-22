@extends('admin.index')
@inject('model', 'App\User')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
	    <section class="content-header">
	      <h1>
	        تغيير كلمة المرور
	      </h1>
	      <br>
	      <ol class="breadcrumb">
	        <li style="float: left;"><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i>الرئيسيه</a></li>
	      </ol>
	    </section>
	    <div class="container">
			<div class="raw">
		
			    <div class="col-md-6">

				
			    	{!! Form::model($model, ['action' => 'Admin\UserController@changePasswordSave']) !!}
				    	
				    	<div class="form-group">
				    		<label for="old-password">كلمة المرور القديمه</label>
				    		{!!Form::text('old-password', null, ['class'=>'form-control'])!!}
				    	</div>
				    	<div class="form-group">
				    		<label for="password">كلمة المرور الجديده</label>
				    		{!!Form::text('password', null, ['class'=>'form-control'])!!}
				    	</div>

				    	<div class="form-group">
				    		<button class="btn btn-primary" type="submit">حفظ</button>
				    	</div>
			    	{!!Form::close()!!}

				</div>
			</div>
	</div>
</div>

@endsection