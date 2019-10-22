@extends('admin.index')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        المستخدمين
      </h1>

      <ol class="breadcrumb">
        <li style="float: left;"><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i> الرئيسيه</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    	<a href="{{url('admin/users/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> اضافة مستخدم</a>
        @include('flash::message')
    	<div class="table-responsive">
    		<table class="table table-borderd table-striped table-hover">
    			<thead>
    				<tr>
        				<th>#</th>
        				<th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
        				<th>Edit</th>
        				<th>Delete</th>
    				</tr>
    			</thead>
    			<tbody>
    				@forelse($records as $record)

    					<tr>
        				<td>{{$loop->iteration}}</td>
        				<td>{{$record->name}}</td>
                        <td>{{$record->email}}</td>
                         <td>
                             @foreach($record->roles as $role)
                                {{$role->display_name}}
                             @endforeach
                         </td>

        				<td>
                            <a href="{{url(route('users.edit', $record->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>            
                        </td>
        				<td>
                            {!!Form::open([ 'route'=>['users.destroy', $record->id]            ,'method'=>'delete'] )!!}
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
    <!-- /.content -->
  </div>

@endsection