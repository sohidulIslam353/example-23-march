@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_responsive.css">
<script src="{{ asset('public/js/share.js') }}"></script>

@include('layouts.front_partial.collaps_nav')

<style type="text/css">
	.checked {
  color: orange;
}
</style>

@php
 $review_5=App\Models\Review::where('product_id',$product->id)->where('rating',5)->count();
 $review_4=App\Models\Review::where('product_id',$product->id)->where('rating',4)->count();
 $review_3=App\Models\Review::where('product_id',$product->id)->where('rating',3)->count();
 $review_2=App\Models\Review::where('product_id',$product->id)->where('rating',2)->count();
 $review_1=App\Models\Review::where('product_id',$product->id)->where('rating',1)->count();

 $sum_rating=App\Models\Review::where('product_id',$product->id)->sum('rating');
 $count_rating=App\Models\Review::where('product_id',$product->id)->count('rating');

 //Share plugin 
			 // Share button 1
         $shareButtons1 = \Share::page(
              url()->current()
         )
         ->facebook()
         ->twitter()
         ->linkedin()
         ->telegram()
         ->whatsapp() 
         ->reddit();


@endphp
<!-- Single Product -->

<div class="single_product">
	<div class="container">
		<div class="row">
			@php
			 $images=json_decode($product->images,true);
			 $color=explode(',',$product->color);
			 $sizes=explode(',',$product->size);
			 
			@endphp
			

			<!-- Images -->
			<div class="col-lg-1 order-lg-1 order-2" >
				<ul class="image_list">
				@isset($images)	
					@foreach($images as $key => $image)
					<li data-image="{{ asset('public/files/product/'.$image) }}">
						<img src="{{ asset('public/files/product/'.$image) }}" alt="">
					</li>
					@endforeach
				@endisset	
				</ul>
			</div>

			<!-- Selected Image -->
			<div class="col-lg-4 order-lg-2 order-1">

				<div class="image_selected"><img src="{{ asset('public/files/product/'.$product->thumbnail) }}" alt=""></div>
			</div>

			<!-- Description -->
			<div class="col-lg-4 order-3">

				<div class="product_description">
					<div class="product_category">{{ $product->category->category_name }} > {{ $product->subcategory->subcategory_name }}</div>
					<div class="product_name" style="font-size: 20px;">{{ $product->name }}</div>

					<div class="product_category"><b> Brand: {{ $product->brand->brand_name }} </b></div>
					<div class="product_category"><b> Stock: {{ $product->stock_quantity }} </b></div>
					<div class="product_category"><b> Unit: {{ $product->unit }} </b></div>
					 {{-- review star --}}
					 <div>
					@if($sum_rating !=NULL)	
					 	@if(intval($sum_rating/$count_rating) == 5)
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	@elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5) <$count_rating)
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star "></span>
					 	@elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5) <$count_rating)
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	@elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5) <$count_rating)
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	@else
					 	<span class="fa fa-star checked"></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	<span class="fa fa-star "></span>
					 	@endif
					@endif 	
					 </div>
					<div><br>
						 
          
             <div class="" style="margin-top: 35px;">Price: {{ $setting->currency }}{{$product_price->price}}</div>
           
					</div>


					<div class="order_info d-flex flex-row">
						<form action="{{ route('add.to.cart.quickview') }}" method="post" id="add_to_cart">
							@csrf
							<input type="hidden" name="id" value="{{$product->id}}">
             				<input type="hidden" name="price" value="{{$product_price->price}}">
             

							<div class="form-group">
									<div class="row">
										@isset($product->size)
										<div class="col-lg-6">
											<label>Pick Size: </label>
											<select class="custom-select form-control-sm" name="size" style="min-width: 120px;">
												@foreach($sizes as $size)
												   <option value="{{ $size }}">{{ $size }}</option>
												@endforeach
											</select>
										</div>
										@endisset

										@isset($product->color)
										<div class="col-lg-6">
											<label>Pick Color: </label>
											<select class="custom-select form-control-sm" name="color" style="min-width: 120px;">
												@foreach($color as $row)
												   <option value="{{ $row }}">{{ $row }}</option>
												@endforeach
											</select>
										</div>
										@endisset
									</div>
								</div>
								<br>
							<div class="clearfix" style="z-index: 1000;">
								
								<!-- Product Quantity -->
								<div class="product_quantity clearfix ml-2">
									<span>Quantity: </span>
									<input id="quantity_input" type="text" name="qty" pattern="[1-9]*" min="1" value="1">
									<div class="quantity_buttons">
										<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
										<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
									</div>
								</div>
							</div>
						
							<div class="button_container">
								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								  	@if($product->stock_quantity<1)
								  	<button class="btn btn-outline-danger" disabled="">Stock Out</button>
								  	@else
								    <button class="btn btn-outline-info" type="submit"> <span class="loading d-none">....</span> Add to cart</button>
								    @endif

								    <a href="{{ route('add.wishlist',$product->id) }}" class="btn btn-outline-primary" type="button">Add to wishlist</a>
								  </div>
								</div>
							</div>
								
						</form>

					</div>
				</div>

			</div>


			<div class="col-lg-3 order-3" style="border-left: 1px solid grey; padding-left: 10px;">
					{!! $shareButtons1 !!}
				<strong class="text-muted">Pickup Point of this product</strong><br>
				<i class="fa fa-map"> {{ $product->pickuppoint->pickup_point_name }} </i><hr><br>
				<strong class="text-muted"> Home Delivery :</strong><br>
				 -> (4-8) days after the order placed.<br> 
				 -> Cash on Delivery Available.
				 <hr><br>
				 <strong class="text-muted"> Product Return & Warrenty :</strong><br>
				 -> 7 days return guarranty.<br> 
				 -> Warrenty not available.
				 <hr><br>
				@isset($product->video) 
				 <strong>Product Video : </strong>
				 <iframe width="340" height="205" src="https://www.youtube.com/embed/{{ $product->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				@endisset 
			</div>

		</div><br><br>
		<div class="row">
			<div class="col-lg-12">
			 <div class="card">
			  <div class="card-header">
				<h4>Product details of {{ $product->name }}</h4>
			  </div>
				<div class="card-body">
						{!! $product->description !!}
				</div>
			 </div>
			</div>
		</div><br>
		<div class="row">
			<div class="col-lg-12">
			 <div class="card">
			  <div class="card-header">
				<h4>Ratings & Reviews of  {{ $product->name }}</h4>
			  </div>
			  


				<div class="card-body">
					<div class="row">
						<div class="col-lg-3">
							Average Review of  {{ $product->name }}:<br>
						@if($sum_rating !=NULL)
							@if(intval($sum_rating/$count_rating) == 5)
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							@elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5) <$count_rating)
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star "></span>
							@elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5) <$count_rating)
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							@elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5) <$count_rating)
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							@else
							<span class="fa fa-star checked"></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							<span class="fa fa-star "></span>
							@endif
						@endif	
						</div>
						<div class="col-md-3">
							{{-- all review show --}}
							Total Review Of This Product:<br>
						 	 		  <div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span> Total {{ $review_5 }} </span>
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span> Total {{ $review_4 }} </span>
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span> Total {{ $review_3 }} </span>
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span> Total {{ $review_2 }} </span>
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span> Total {{ $review_1 }} </span>
										</div>
										
									
						</div>
						<div class="col-lg-6">
							<form action="{{ route('store.review') }}" method="post">
								@csrf
							  <div class="form-group">
							    <label for="details">Write Your Review</label>
							    <textarea type="text" class="form-control" name="review" required=""></textarea>
							  </div>
								<input type="hidden" name="product_id" value="{{ $product->id }}">
							  <div class="form-group ">
							    <label for="review">Write Your Review</label>
							     <select class="custom-select form-control-sm" name="rating" style="min-width: 120px;">
							     	<option disabled="" selected="">Select Your Review</option>
							     	<option value="1">1 star</option>
							     	<option value="2">2 star</option>
							     	<option value="3">3 star</option>
							     	<option value="5">4 star</option>
							     	<option value="5">5 star</option>
							     </select> 
							     
							  </div>
							  @if(Auth::check())
							  <button type="submit" class="btn btn-sm btn-info"><span class="fa fa-star "></span> submit review</button>
							  @else
							   <p>Please at first login to your account for submit a review.</p>
							  @endif
							</form>
						</div>
					</div>
						<br>

					{{-- all review of this product --}}	
						<strong>All review of {{ $product->name }}</strong> <hr>
					<div class="row">
						@foreach($review as $row)
							<div class="card col-lg-5 m-2">
						 	 <div class="card-header">
						 	 		{{ $row->user->name }}  ( {{ date('d F , Y'), strtotime($row->review_date) }} )
						 	 </div>
						 	 <div class="card-body">
						 	 		{{ $row->review }}
						 	 		  @if($row->rating==5)
						 	 		  <div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
										</div>
										@elseif($row->rating==4)
										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
										</div>
										@elseif($row->rating==3)
										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
										</div>
										@elseif($row->rating==2)
										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
										</div>
										@elseif($row->rating==1)
										<div>
											<span class="fa fa-star checked"></span>
										</div>
										@endif
						 	 </div>
						 </div>
					  @endforeach
					</div>	
				</div>


			 </div>
			</div>
		</div>

	 </div>
	</div>
</div>

<!-- related product Viewed -->


<div class="viewed">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="viewed_title_container">
					<h3 class="viewed_title">Related Product</h3>
					<div class="viewed_nav_container">
						<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
						<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
					</div>
				</div>

				<div class="viewed_slider_container">
					
					<!-- related product Viewed Slider -->

					<div class="owl-carousel owl-theme viewed_slider">
					 @foreach($related_product as $row)		
						<!-- Recently Viewed Item -->
						<div class="owl-item">
							<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
								<div class="viewed_image"><img src="{{ asset('public/files/product/'.$row->thumbnail) }}" alt="{{ $row->name }}"></div>
								<div class="viewed_content text-center">
		            			 <div class="viewed_price">{{ $setting->currency }}{{$row->price}}</div>
		           

									
									<div class="viewed_name"><a href="{{ route('campaign.product.details',$row->slug) }}">{{ substr($row->name, 0, 50) }}</a></div>
								</div>
								<ul class="item_marks">
									<li class="item_mark item_discount">new</li>
								</ul>
							</div>
						</div>
					 @endforeach	
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
	 //store coupon ajax call
  $('#add_to_cart').submit(function(e){
    e.preventDefault();
    var url = $(this).attr('action');
    var request =$(this).serialize();
    $.ajax({
      url:url,
      type:'post',
      async:false,
      data:request,
      success:function(data){
        toastr.success(data);
        $('#add_to_cart')[0].reset();
        cart();
      }
    });
  });
</script>

@endsection