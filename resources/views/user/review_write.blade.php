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
                   <h4>Write your valuable review based on our product quality and services.</h4><br>
                   <div>
                   	  <form action="{{ route('store.website.review') }}" method="post">
                   	  	@csrf
                   	    <div class="form-group">
                   	      <label for="exampleInputEmail1">Customer Name</label>
                   	      <input type="text" class="form-control" name="name" readonly="" value="{{ Auth::user()->name }}">
                   	    </div>
                   	    <div class="form-group">
                   	      <label for="exampleInputPassword1">Write Review</label>
                   	      <textarea class="form-control" name="review" required=""></textarea>
                   	    </div>
                   	    <div>
                   	    	<label for="exampleInputPassword1">Rating</label>
                   	    	<select class="form-control" name="rating" style="min-width: 200px;">
                   	    		<option value="1">1 star</option>
                   	    		<option value="2">2 star</option>
                   	    		<option value="3">3 star</option>
                   	    		<option value="4">4 star</option>
                   	    		<option value="5" selected="">5 star</option>
                   	    	</select>
                   	    </div><br>
                   	    <button type="submit" class="btn btn-primary">Submit Review</button>
                   	  </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div><hr>
@endsection
