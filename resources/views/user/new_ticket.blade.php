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
                   <strong>Submit your ticket we will reply.</strong><br>
                   <div>
                   	  <form action="{{ route('store.ticket') }}" method="post" enctype="multipart/form-data">
                   	  	@csrf
                   	    <div class="form-group">
                   	      <label for="exampleInputEmail1">Subject</label>
                   	      <input type="text" class="form-control" name="subject" required>
                   	    </div>
                   	    <div class="row">
	                   	    <div class="form-group col-6">
	                   	      <label for="exampleInputEmail1">Priority</label>
	                   	      <select class="form-control" name="priority" style="min-width: 220px;">
	                   	      	<option value="Low">Low</option>
	                   	      	<option value="Medium">Medium</option>
	                   	      	<option value="High">High</option>
	                   	      </select>
	                   	    </div>
	                   	    <div class="form-group col-6">
	                   	      <label for="exampleInputEmail1">Service</label>
	                   	      <select class="form-control" name="service" style="min-width:220px;">
	                   	      	<option value="Technical">Technical</option>
	                   	      	<option value="Payment">Payment</option>
	                   	      	<option value="Affiliate">Affiliate</option>
	                   	      	<option value="Return">Return</option>
	                   	      	<option value="Refund">Refund</option>
	                   	      </select>
	                   	    </div>
                   	    </div>
                   	    <div class="form-group">
                   	      <label for="exampleInputPassword1">Message</label>
                   	      <textarea class="form-control" name="message" required=""></textarea>
                   	    </div>
                   	    <div>
                   	    	<label for="exampleInputPassword1">Image</label>
                   	    	<input type="file" class="form-control" name="image" >
                   	    </div><br>
                   	    <button type="submit" class="btn btn-primary">Submit Ticket</button>
                   	  </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div><hr>
@endsection
