@extends('admin.index')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        العملاء
      </h1>
      <ol class="breadcrumb">
        <li style="float: left;"><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i> الرئيسيه</a></li>
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
        				<th>اسم العميل</th>
                        <th>الهاتف</th>
                        <th>الايميل</th>
                        <th>المدينه</th>
                        <th>المنطقه</th>
        				<th>مفعل/غير مفعل</th>
        				<th>حذف</th>
    				</tr>
    			</thead>
    			<tbody>
    				@forelse($clients as $client)

    					<tr style="text-align: center;">
            				<td>{{$loop->iteration}}</td>
            				<td>{{$client->name}}</td>                            
                            <td>{{$client->phone}}</td>
                            <td>{{$client->email}}</td>
                            <td>{{$client->region ? optional($client->region->city)->name : ''}}</td>
                            <td>{{optional($client->region)->name}}</td>
                            
                            <td>
                                @if($client->active)
                                        <a href="clients/{{$client->id}}/deActive" class="btn btn-xs btn-danger"><i class="fa fa-close"></i>غير  مفعل</a>
                                    @else
                                        <a href="clients/{{$client->id}}/active" class="btn btn-xs btn-success"><i class="fa fa-check"></i>تفعيل</a>
                                @endif
                                
                            </td>

            				<td>
                                {!!Form::open([ 'route'=>['clients.destroy', $client->id],'method'=>'delete'] )!!}
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
        	     
{{$clients->render()}}
    </section>

</div>

@endsection