@extends('admin.index')
@inject('restaurant','App\Restaurant')
@inject('client','App\Client')

@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        لوحة التحكم
      </h1>

      <ol class="breadcrumb">
        <li  style="float: left;"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!--Clients count-->
      <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Restaurants</span>
              <span class="info-box-number">{{$restaurant->count()}}</span>
            </div>
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Clients</span>
              <span class="info-box-number">{{$client->count()}}</span>
            </div>
          </div>
          <!-- /.info-box -->
        </div>

        <!--Donation requests count-->
      <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-line-chart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Donation Requests</span>
              <span class="info-box-number"></span>
            </div>
            
          </div>
          <!-- /.info-box -->
        </div>  
     

    </section>
    <!-- /.content -->
  </div>

@endsection