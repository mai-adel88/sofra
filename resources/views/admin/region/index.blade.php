@extends('admin.index')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Regions
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <a href="{{route('regions.create')}}" class="btn btn-primary">Add New Region</a>

        @include('flash::message')
    	<div class="table-responsive">
    		<table class="table table-borderd table-striped table-hover">
    			<thead style="text-align: center;">
    				<tr>
        				<th>#</th>
        				<th>Region</th>
                        <th>City</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        
    				</tr>
    			</thead>
    			<tbody>
    				@forelse($regions as $region)

    					<tr>
            				<td>{{$loop->iteration}}</td>
            				<td>{{$region->name}}</td>
                            <td>{{$region->city->name}}</td>
                            
                            <td>
                                <a href="{{url(route('regions.edit', $region->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>            
                            </td>

            				<td>
                                {!!Form::open([ 'route'=>['regions.destroy', $region->id],'method'=>'delete'] )!!}
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
{{$regions->render()}}
</div>

@endsection