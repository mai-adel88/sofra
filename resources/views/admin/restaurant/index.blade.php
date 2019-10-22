@extends('admin.index')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        قائمة المطاعم
      </h1>
      <ol class="breadcrumb">
        <li style="float: left;"><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i> الرئيسيه</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
        @include('flash::message')
        {{ Form::open([
         'url' => 'admin/restaurant/search/',
         'method' => 'POST'
         ]) }}
       <div class="input-group col-md-3">
             <input type="text" name="name" class="form-control" placeholder="Search...">
             <span class="input-group-btn">
                   <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                   </button>
                 </span>
           </div>
       {{ Form::close()}}

    	<div class="table-responsive">
    		<table class="table table-borderd table-striped table-hover">
    			<thead style="text-align: center;">
    				<tr>
        				<th>#</th>
        				<th>اسم المطعم</th>
                        <th>الهاتف</th>
                        <th>المدينه</th>
                        <th>المنطقه</th>
                        <th>هاتف التوصيل</th>
        				<th>حالة المطعم</th>
                        <th>مفعل/غير مفعل</th>
        				<th>حذف</th>
    				</tr>
    			</thead>
    			<tbody>
    				@forelse($restaurants as $restaurant)

    					<tr style="text-align: center;">
            				<td>{{$loop->iteration}}</td>
            				<td>{{$restaurant->name}}</td>
                            <td>{{$restaurant->phone}}</td>
                            <td>{{$restaurant->region ? optional($restaurant->region->city)->name : ''}}</td>
                            <td>{{optional($restaurant->region)->name}}</td>
                            <td>{{$restaurant->phone_delivery}}</td>
                            <td>
                                @if($restaurant->status)
                                    <i style="color: green;" class="fa fa-circle"></i> مفتوح
                                @else
                                    <p>مغلق</p>
                                @endif
                                
                            </td>
                            <td>
                                @if($restaurant->active)
                                        <a href="restaurants/{{$restaurant->id}}/deActive" class="btn btn-xs btn-danger"><i class="fa fa-close"></i>غير  مفعل</a>
                                    @else
                                        <a href="restaurants/{{$restaurant->id}}/active" class="btn btn-xs btn-success"><i class="fa fa-check"></i>تفعيل</a>
                                @endif
                                
                            </td>

            				<td>
                                {!!Form::open([ 'route'=>['restaurant.destroy', $restaurant->id],'method'=>'delete'] )!!}
                                <div class="form-group">
                                    <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash-o"></i></button>
                                </div>
                                {!!Form::close()!!}                
                            </td>
    					</tr>
    				@empty
    				<tr>
    					<td colspan="4">
    						<div class="alert alert-danger">no data</div>

    					</td>
    				</tr>
					@endforelse
    					
    			</tbody>
    			
    		</table>
    	</div>
        	     
{{$restaurants->render()}}
    </section>

</div>

@endsection