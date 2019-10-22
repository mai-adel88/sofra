@extends('admin.index')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        العمليات الماليه
      </h1>
      <ol class="breadcrumb">
        <li style="float:left;"><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i>الرئيسيه</a></li>
      </ol>
    </section>

    

    <!-- Main content -->
    <section class="content">
        <a href="{{route('payments.create')}}" class="btn btn-primary">اضافة </a>
        @include('flash::message')
    	<div class="table-responsive">
    		<table class="table table-borderd table-striped table-hover">
    			<thead style="text-align: center;">
    				<tr>
        				<th>#</th>
        				<th>اسم المطعم</th>
                        <th>المبلغ المدفوع</th>
                        <th>ملاحظات</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                        
    				</tr>
    			</thead>
    			<tbody>
    				@forelse($payments as $payment)

    					<tr>
            				<td>{{$loop->iteration}}</td>
            				<td>{{$payment->restaurant->name}}</td>
                            <td>{{$payment->paid}}</td>
                            <td>{{$payment->note}}</td>
                            
                            <td>
                                <a href="{{url(route('payments.edit', $payment->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>            
                            </td>

            				<td>
                                {!!Form::open([ 'route'=>['payments.destroy', $payment->id],'method'=>'delete'] )!!}
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
{{$payments->render()}}
</div>

@endsection