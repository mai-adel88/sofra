@extends('admin.index')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        تواصل معنا
      </h1>
      <ol class="breadcrumb">
        <li style="float:left;"><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i>الرئيسيه</a></li>
      </ol>
    </section>

    

    <!-- Main content -->
    <section class="content">
        @include('flash::message')
    	<div class="table-responsive">
    		<table class="table table-borderd table-striped table-hover">
    			<thead style="text-align: center;">
    				<tr>
        				<th>#</th>
                        <th>الاسم</th>
                        <th>الهاتف</th>
                        <th>الايميل</th>
                        <th>الرسال</th>
                        <th>النوع</th>
                        <th>حذف</th>
                        
    				</tr>
    			</thead>
    			<tbody>
    				@forelse($contacts as $contact)

    					<tr>
            				<td>{{$loop->iteration}}</td>
            				<td>{{$contact->full_name}}</td>
                            <td>{{$contact->phone}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{$contact->message}}</td>
                            <td>{{$contact->states}}</td>
            				<td>
                                {!!Form::open([ 'route'=>['contacts.destroy', $contact->id],'method'=>'delete'] )!!}
                                <div class="form-group">
                                    <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash-o"></i></button>
                                </div>
                                {!!Form::close()!!}                
                            </td>
    					</tr>
    				@empty
    				<tr>
    					<td colspan="4">
    						<div class="alert alert-danger">لا توجد بيانات</div>

    					</td>
    				</tr>
					@endforelse
    					
    			</tbody>
    			
    		</table>
    	</div>
        	     

    </section>
{{$contacts->render()}}
</div>

@endsection