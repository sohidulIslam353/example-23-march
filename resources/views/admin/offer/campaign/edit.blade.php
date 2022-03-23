<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
  <form action="{{ route('campaign.update') }}" method="Post" enctype="multipart/form-data">
      @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="brand-name">Campaign Title </label>
            <input type="text" class="form-control"  name="title" value="{{ $data->title }}" required="">
          </div>
          <input type="hidden" name="id" value="{{ $data->id }}">
           <div class="row">
           	<div class="col-lg-6">
           		<div class="form-group">
           		  <label for="start-date">Start Date <span class="text-danger">*</span></label>
           		  <input type="date" class="form-control" value="{{ $data->start_date }}" name="start_date" required="">
           		</div>
           	</div>
           	<div class="col-lg-6">
           		<div class="form-group">
           		  <label for="End-date">End Date <span class="text-danger">*</span></label>
           		  <input type="date" class="form-control" value="{{ $data->end_date }}" name="end_date" required="">
           		</div>
           	</div>
           </div>
           <div class="row">
           	<div class="col-lg-6">
           		<div class="form-group">
           		  <label for="start-date">Status<span class="text-danger">*</span></label>
           		  <select class="form-control" name="status">
           		  	<option value="1" @if($data->status==1) selected="" @endif>Active</option>
           		  	<option value="0" @if($data->status==0) selected="" @endif>Inactive</option>
           		  </select>
           		</div>
           	</div>
           	<div class="col-lg-6">
           		<div class="form-group">
           		  <label for="End-date">Discount (%) <span class="text-danger">*</span></label>
           		  <input type="number" class="form-control" value="{{ $data->discount }}" name="discount" required="">
           		  <small id="emailHelp" class="form-text text-danger">Discount percentage are apply for all prodcut selling price</small>

           		</div>
           	</div>
           </div>
           <div class="form-group">
            <label for="brand-name">Brand Logo</label>
            <input type="file"  class="dropify" data-height="140"  name="image" >
            <input type="hidden" name="old_image" value="{{ $data->image }}">
          </div>   
      </div>
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary"> <span class="d-none"> loading..... </span>  Update</button>
      </div>
</form>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
<script type="text/javascript">
	$('.dropify').dropify();

</script>