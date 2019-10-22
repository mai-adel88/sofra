@extends('admin.index')
@inject('item', 'App\ItemOrder')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        عرض الطلب رقم  {{$order->id}}    
      </h1>
      <ol class="breadcrumb">
        <li style="float:left;"><a href="{{url('admin/home')}}"><i class="fa fa-dashboard"></i>الرئيسيه</a></li>
      </ol>
    </section>

    

    <!-- Main content -->
    <section class="content">
        @include('flash::message')
    	<div class="client">
    		<h3>تفاصيل الطلب</h3>
            <div class="order_details">
                <div class="col-md-4">
                    <h4>من</h4>
                    <p>اسم المطعم :{{$order->restaurant->name}}</p>
                    <p>الهاتف :{{$order->restaurant->phone}}</p>
                </div>

                <div class="col-md-4">
                    <h4>الى</h4>
                    <p>اسم العميل :{{$order->client->name}}</p>
                    <p>العنوان :{{$order->address}}</p>
                    <p>طريقة الدفع  :{{$order->paymentMethod->name}}</p>
                </div>

                <div class="end">
                    <p>وقت الطلب : {{$order->created_at}}</p>
                    <p>حالة الطلب :{{$order->state}}</p>
                </div>
    		</div>

    	</div>

        @if($order->state == 'delivered' || $order->state == 'pending')
            <div class="client">
                <h3>تفاصيل الطلب</h3>
                <div class="order_details">
                    <div class="table-responsive">
                        <table class="table table-borderd table-striped table-hover">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>اسم الوجبه</th>
                                    <th>الكميه</th>  
                                    <th>الاجمالي</th>  
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($order->items as $item)
                                    <tr>
                                        <td>gg</td>
                                        <td>{{$item->pivot->quantity}}</td>
                                        <td>{{$item->pivot->total_price}}</td> 
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
                </div>
                    <button id="print-all"  style="margin: 5px;" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>    
            </div>
        @else
            <p>الطلب لم يتم استلامه</p>
        @endif
        	     

    </section>
</div>
 @push('print')
    <script>
        $("#print-all").click(function(){
          window.print();
        });
    </script>
@endpush
@endsection