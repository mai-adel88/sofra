@extends('admin.index')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        الطلبات        
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
        				
                        <th>رقم  الطلب</th>
        				<th>اسم المطعم</th>
                        <th>الاجمالي</th>
                        
                        <th>الحاله</th>
                        <th>وقت الطلب</th>
                        <th>عرض الطلب</th>
                        
                        
    				</tr>
    			</thead>
    			<tbody>
    				@forelse($orders as $order)

    					<tr>
            				<td>{{$order->id}}#</td>
            				<td>{{$order->restaurant->name}}</td>
                            <td>{{$order->total}}</td>
                            <td>{{$order->state}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                <button class="btn btn-primary"><a href="{{url(route('orders.show',$order->id))}}" style="color: #fff;">
                              عرض الطلب
                            </a></button>
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
{{$orders->render()}}
</div>

@endsection