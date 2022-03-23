@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('user.sidebar')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                </div>
                <div class="card-body mt-2">
                	Name: {{ $order->c_name }} <br>	
                	Phone: {{ $order->c_phone }} <br>	
                	OrderID: {{ $order->order_id }} <br>	
                	Status: @if($order->status==0)
                                 <span class="badge badge-danger">Order Pending</span>
                              @elseif($order->status==1)
                                 <span class="badge badge-info">Order Recieved</span>
                              @elseif($order->status==2)
                                 <span class="badge badge-primary">Order Shipped</span>
                              @elseif($order->status==3)
                                 <span class="badge badge-success">Order Completed</span> 
                              @elseif($order->status==4)
                                 <span class="badge badge-warning">Order Return</span>   
                              @elseif($order->status==5)  
                                 <span class="badge badge-danger">Order Cancel</span>
                              @endif   <br>	
                	Date: {{ date('d F Y'),strtotime($order->c_name)}} <br>	
                	Subtotal: {{ $order->subtotal }} {{ $setting->currency }}<br>	
                	Total: {{ $order->total }} {{ $setting->currency }}<br>

                </div>
                <div class="card-body">
                   <h4>My Order</h4>
                   <div>
                       <table class="table">
                         <thead>
                           <tr>
                             <th scope="col">SL</th>
                             <th scope="col">Product</th>
                             <th scope="col">Color</th>
                             <th scope="col">Size</th>
                             <th scope="col">Qty</th>
                             <th scope="col">Price</th>
                             <th scope="col">Subtotal</th>
                           </tr>
                         </thead>
                         <tbody>
                          @foreach($order_details as $key=>$row)
                           <tr>
                             <th scope="row">{{ ++$key }}</th>
                             <td>{{ $row->product_name  }}</td>
                             <td>{{ $row->color }} </td>
                             <td>{{ $row->size }}</td>
                             <td>{{ $row->quantity }}</td>
                             <td>{{ $row->single_price }} {{ $setting->currency }}</td>
                             <td>{{ $row->subtotal_price }} {{ $setting->currency }}</td>
                           </tr>
                          @endforeach 
                         </tbody>
                       </table>
                   </div>
                </div>

                

            </div>
        </div>
    </div>
</div><hr>
@endsection
