<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 30px;
  height: 30px;
  margin-left: 45%;
  margin-top: 15%;
  margin-bottom: 18%;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


</style>

  @php
	 $color=explode(',',$product->color);
	 $sizes=explode(',',$product->size);
	@endphp
    {{-- preloader for product quick view --}}
    <div class="loader"></div>

      <div class="modal-body product_view d-none">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-4">
                <div class="">
                    <img src="{{ asset('public/files/product/'.$product->thumbnail) }}" height="100%" width="100%">
                </div>
              </div>
              <div class="col-lg-8 ">
                <h3>{{ $product->name }}</h3>
                 <p>{{ $product->category->category_name }} > {{ $product->subcategory->subcategory_name }}</p>
                 <p>Brand: {{ $product->brand->brand_name }}</p>
                 <p>Stock: @if($product->stock_quantity<1) <span class="badge badge-danger">Stock Out</span> @else <span class="badge badge-success">Stock Available</span> @endif </p>
                 <div class="">
                  @if($product->discount_price==NULL)
			             <div class="">Price: {{ $setting->currency }}{{ $product->selling_price }}</div>
			            @else
			              <div class="" >
			              Price: <del class="text-danger">{{ $setting->currency }}{{ $product->selling_price }}</del class="text-danger">
			              	{{ $setting->currency }}{{ $product->discount_price }}</div>
			            @endif
              	</div>

              	<br>
                 <div class="order_info d-flex flex-row">
                    <form action="{{ route('add.to.cart.quickview') }}" method="post" id="add_cart_form">
                      @csrf
                      {{-- cart add details --}}
                      <input type="hidden" name="id" value="{{$product->id}}">
                      @if($product->discount_price==NULL)
                      <input type="hidden" name="price" value="{{$product->selling_price}}">
                      @else
                      <input type="hidden" name="price" value="{{$product->discount_price}}">
                      @endif
                        <div class="form-group">
                                <div class="row">
                                    @isset($product->size)
                  										<div class="col-lg-4">
                  											<label>Size: </label>
                  											<select class="custom-select form-control-sm" name="size" style="min-width: 120px; margin-left: -4px;">
                  												@foreach($sizes as $size)
                  												   <option value="{{ $size }}">{{ $size }}</option>
                  												@endforeach
                  											</select>
                  										</div>
                  									@endisset
                                    @isset($product->color)
                                    <div class="col-lg-4">
                                    	<label>Color: </label>
                                    	<select class="custom-select form-control-sm" name="color" style="min-width: 120px;">
                                    		@foreach($color as $row)
                                    		   <option value="{{ $row }}">{{ $row }}</option>
                                    		@endforeach
                                    	</select>
                                    </div>
                                    @endisset
                                    
                                </div>
                                <div class="col-lg-4" style="margin-left: -5px;">
                                  <label>Quantity: </label>
                                    <input type="number" min="1" max="100" name="qty" class="form-control-sm" value="1" style="min-width: 120px; margin-left: -4px;">
                                </div>
                            </div>
                        <div class="button_container">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                              	@if($product->stock_quantity<1)
                              	<span class="text-danger">Stock Out</span>
                              	@else
                                <button class="btn btn-sm btn-outline-info" type="submit" style="float: right;">
                               <span class="loading d-none">....</span> Add to cart</button>
                                @endif
                              </div>
                            </div>
                        </div>
                        
                    </form>
                 </div>
              </div>
            </div>
          </div>
        </div> 


<script type="text/javascript">
$('.loader').ready(function() {
  setTimeout(function() {
    $('.product_view').removeClass("d-none");
    $('.loader').css("display", "none");
  }, 500);
});
</script>  

<script type="text/javascript">
  //store coupon ajax call
  $('#add_cart_form').submit(function(e){
    e.preventDefault();
    $('.loading').removeClass('d-none');
    var url = $(this).attr('action');
    var request =$(this).serialize();
    $.ajax({
      url:url,
      type:'post',
      async:false,
      data:request,
      success:function(data){
        toastr.success(data);
        $('#add_cart_form')[0].reset();
        $('.loading').addClass('d-none');
        cart();
      }
    });
  });
</script>   