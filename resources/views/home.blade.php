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
                    <a href="{{ route('write.review') }}" style="float:right;"><i class="fas fa-pencil-alt"></i> Write a review</a>
                </div>

                <div class="card-body">
                   <div class="row">
                       <div class="col-lg-3">
                           <a href=""> 
                             <div class="card" >
                               <div class="card-body">
                                 <h5 class="card-title text-success text-center">Total Order</h5>
                                 <h6 class="card-subtitle mb-2 text-muted text-center">{{ $total_order }}</h6>
                               </div>
                             </div>
                           </a>
                       </div>
                       <div class="col-lg-3">
                           <a href=""> 
                             <div class="card" >
                               <div class="card-body">
                                 <h5 class="card-title text-success text-center">Complete Order</h5>
                                 <h6 class="card-subtitle mb-2 text-muted text-center">{{ $complete_order }}</h6>
                               </div>
                             </div>
                           </a>
                       </div>
                       <div class="col-lg-3">
                           <a href=""> 
                             <div class="card" >
                               <div class="card-body">
                                 <h5 class="card-title text-danger text-center">Cancel Order</h5>
                                 <h6 class="card-subtitle mb-2 text-muted text-center">{{ $cancel_order }}</h6>
                               </div>
                             </div>
                           </a>
                       </div>
                       <div class="col-lg-3">
                          <a href=""> 
                            <div class="card" >
                              <div class="card-body">
                                <h5 class="card-title text-warning text-center">Return Order</h5>
                                <h6 class="card-subtitle mb-2 text-muted text-center">{{ $return_order }}</h6>
                              </div>
                            </div>
                          </a>
                       </div>
                   </div><br>
                   <h4>Recent Order</h4>
                   <div>
                       <table class="table">
                         <thead>
                           <tr>
                             <th scope="col">OrderId</th>
                             <th scope="col">Date</th>
                             <th scope="col">Total</th>
                             <th scope="col">Payment Type</th>
                             <th scope="col">Status</th>
                           </tr>
                         </thead>
                         <tbody>
                          @foreach($orders as $row)
                           <tr>
                             <th scope="row">{{ $row->order_id }}</th>
                             <td>{{ date('d F , Y') ,strtotime($row->order_id)  }}</td>
                             <td>{{ $row->total }} {{ $setting->currency }}</td>
                             <td>{{ $row->payment_type }}</td>
                             <td>
                              @if($row->status==0)
                                 <span class="badge badge-danger">Order Pending</span>
                              @elseif($row->status==1)
                                 <span class="badge badge-info">Order Recieved</span>
                              @elseif($row->status==2)
                                 <span class="badge badge-primary">Order Shipped</span>
                              @elseif($row->status==3)
                                 <span class="badge badge-success">Order Done</span> 
                              @elseif($row->status==4)
                                 <span class="badge badge-warning">Order Return</span>   
                              @elseif($row->status==5)  
                                 <span class="badge badge-danger">Order Cancel</span>
                              @endif          
                            </td>
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
