@extends('admin.index')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Categories
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <a href="{{route('categories.create')}}" class="btn btn-primary">Add New Category</a>

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
    				@forelse($categories as $category)

    					<tr>
            				<td>{{$loop->iteration}}</td>
            				<td>{{$category->name}}</td>
                            
                            <td>
                                <a href="{{url(route('categories.edit', $category->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>            
                            </td>

            				<td>
                                {!!Form::open([ 'route'=>['categories.destroy', $category->id],'method'=>'delete'] )!!}
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
{{$categories->render()}}
</div>

@endsection