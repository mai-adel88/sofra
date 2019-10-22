@extends('admin.index')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cities
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <a href="{{route('cities.create')}}" class="btn btn-primary">Add New City</a>

    <!-- Main content -->
    <section class="content">
        @include('flash::message')
    	<div class="table-responsive">
    		<table class="table table-borderd table-striped table-hover">
    			<thead style="text-align: center;">
    				<tr>
        				<th>#</th>
        				<th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        
    				</tr>
    			</thead>
    			<tbody>
    				@forelse($cities as $city)

    					<tr>
            				<td>{{$loop->iteration}}</td>
            				<td>{{$city->name}}</td>
                            
                            <td>
                                <a href="{{url(route('cities.edit', $city->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>            
                            </td>

            				<td>
                                {!!Form::open([ 'route'=>['cities.destroy', $city->id],'method'=>'delete'] )!!}
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
        	     

    </section>
{{$cities->render()}}
</div>

@endsection