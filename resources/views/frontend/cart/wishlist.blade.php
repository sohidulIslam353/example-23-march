@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_responsive.css">
@include('layouts.front_partial.collaps_nav')


	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 ">
					<div class="cart_container">
						<div class="cart_title">Your Wishlist Item</div>
						  <div class="cart_items">
							<ul class="cart_list">

								@foreach($wishlist as $row)
								
								<li class="cart_item clearfix">
									
									<div class="cart_item_image">
									 	<img src="{{ asset('public/files/product/'.$row->thumbnail) }}" alt="">
									</div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_text">{{ substr($row->name,0,15) }}..</div>
										</div>
										
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_text">
												{{ $row->date }}
										    </div>
										</div>

										<div class="cart_item_price cart_info_col">
											<a href="{{ route('product.details',$row->slug) }}" class="button cart_button_clear btn-danger">Add To Cart</a>
										</div>

										<div class="cart_item_price cart_info_col">
											<a href="{{ route('wishlistproduct.delete',$row->id) }}" class="text-danger"> X </a>
										</div>
										
									</div>
								</li>
								@endforeach

								
							</ul>
						</div>
						

						

						<div class="cart_buttons">
							<a href="{{ route('clear.wishlist') }}" class="button cart_button_checkout">Clear Wishlist</a>
							<a href="{{ url('/') }}" class="button cart_button_checkout">Back To Home</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	
@endsection