     <form action="{{ route('update.order.status') }}" method="Post" id="edit_form">
      	@csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="coupon_code">Name <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" value="{{ $order->c_name }}"  name="c_name" required="">
            <input type="hidden" name="id" value="{{ $order->id }}">
          </div> 
          <div class="form-group">
            <label for="coupon_code">Email <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" value="{{ $order->c_email }}"  name="c_email" required="">
          </div>     
          <div class="form-group">
            <label for="coupon_amount">Address <span class="text-danger">*</span></label>
            <input type="text" class="form-control" value="{{ $order->c_address }}" name="c_address" required="">
          </div>
          <div class="form-group">
            <label for="coupon_amount">Phone <span class="text-danger">*</span></label>
            <input type="text" class="form-control" value="{{ $order->c_phone }}" name="c_phone" required="">
          </div>
          <div class="form-group">
            <label for="coupon_amount">Order Status </label>
            <select class="form-control" name="status" >
      		 	    <option value="0" @if($order->status==0) selected @endif>Pending</option>
						<option value="1" @if($order->status==1) selected @endif>Recieved</option>
						<option value="2" @if($order->status==2) selected @endif>Shipped</option>
						<option value="3" @if($order->status==3) selected @endif>Completed</option>
						<option value="4" @if($order->status==4) selected @endif>Return</option>
						<option value="5" @if($order->status==5) selected @endif>Canccel</option>
      		 </select>
          </div>   
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary"><span class="loader d-none">..Loading</span>  Update</button>
      </div>
    </form>

    <script type="text/javascript">
    	$('#edit_form').submit(function(e){
		    e.preventDefault();
		    $('.loader').show();
		    var url = $(this).attr('action');
		    var request =$(this).serialize();
		    $.ajax({
		      url:url,
		      type:'post',
		      async:false,
		      data:request,
		      success:function(data){  
		        toastr.success(data);
		        $('#edit_form')[0].reset();
		        $('#editModal').modal('hide');
		        $('.loader').addClass('d-none');
		        table.ajax.reload();
		      }
		    });
		  });
    </script>