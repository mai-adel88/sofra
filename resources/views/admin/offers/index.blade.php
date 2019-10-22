@extends('admin.index')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        العروض
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
                        <th>اسم المطعم</th>
        				<th>العرض</th>
                        <th>وصف العرض</th>
                        <th>الصوره</th>
                        <th>بداية العرض</th>
                        <th>نهاية العرض</th>
                        <th>متاح/غير متاح</th>
                        <th>حذف</th>
                        
    				</tr>
    			</thead>
    			<tbody>
    				@forelse($offers as $offer)

    					<tr>
            				<td>{{$loop->iteration}}</td>
            				<td>{{$offer->restaurant->name}}</td>
                            <td>{{$offer->product_offer_name}}</td>
                            <td>{{$offer->description}}</td>
                            <td>{{$offer->image}}</td>
                            <td>{{$offer->from}}</td>
                            <td>{{$offer->to}}</td>
                            <td style=" text-align: center;">
                                @if($date_now > $offer->to)
                                    <i class="icon-large fa fa-times" style="color: #D73925;"></i>
                                @else
                                    <i class="fa fa-check icon-large" style="color: #048007;"></i>
                                @endif
                            </td>
            				<td>
                                {!!Form::open([ 'route'=>['offers.destroy', $offer->id],'method'=>'delete'] )!!}
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
{{$offers->render()}}
</div>

@endsection