@extends('layouts.admin')

@section('admin_content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pickup Point</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary" data-toggle="modal" data-target="#addModal"> + Add New</button>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pickup Point list </h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Pickup Point</th>
                      <th>Adress</th>
                      <th>Phone</th>
                      <th>Another Phone</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                   
                    </tbody>
                  </table>

                  <form id="deleted_form" action="" method="post">
                      @method('DELETE')
                      @csrf
                  </form>

                </div>
	          </div>
	      </div>
	  </div>
	</div>
</section>
</div>

{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Pickup Point</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div id="modal_body">
        
     </div> 
    </div>
  </div>
</div>


{{-- category insert modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Pickup Point</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form action="{{ route('store.pickup.point') }}" method="Post" id="add_form">
      	@csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="coupon_code">Pickup Point Name <span class="text-danger">*</span> </label>
            <input type="text" class="form-control"  name="pickup_point_name" required="">
          </div>     
          <div class="form-group">
            <label for="coupon_amount">Address <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  name="pickup_point_address" required="">
          </div>
          <div class="form-group">
            <label for="coupon_amount">Phone <span class="text-danger">*</span></label>
            <input type="text" class="form-control"  name="pickup_point_phone" required="">
          </div>
          <div class="form-group">
            <label for="coupon_amount">Another Phone </label>
            <input type="text" class="form-control"  name="pickup_point_phone_two" >
          </div>   
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary"> <span class="loading d-none"> Loading....</span> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
	$(function childcategory(){
		  table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{ route('pickuppoint.index') }}",
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'pickup_point_name'  ,name:'pickup_point_name'},
				{data:'pickup_point_address',name:'pickup_point_address'},
				{data:'pickup_point_phone',name:'pickup_point_phone'},	
				{data:'pickup_point_phone_two',name:'pickup_point_phone_two'},	
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});

  //store coupon ajax call
  $('#add_form').submit(function(e){
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
        $('#add_form')[0].reset();
        $('.loading').addClass('d-none');
        $('#addModal').modal('hide');
        table.ajax.reload();
      }
    });
  }); 

  $('body').on('click','.edit', function(){
    let id=$(this).data('id');
    $.get("pickup-point/edit/"+id, function(data){
      $("#modal_body").html(data);
    });
  });

   //store coupon ajax call
  $('#add_form').submit(function(e){
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
        $('#add_form')[0].reset();
        $('.loading').addClass('d-none');
        $('#addModal').modal('hide');
        table.ajax.reload();
      }
    });
  });
   

	
  
  $(document).ready(function(){
	      $(document).on('click', '#delete_coupon',function(e){
            e.preventDefault();
            var url = $(this).attr('href'); 
            $("#deleted_form").attr('action',url); 
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
              if (willDelete) {
                 $("#deleted_form").submit();
              } else {
                 swal("Your imaginary file is safe!");
              }
            });
         });

        //data passed through here
        $('#deleted_form').submit(function(e){
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
              $('#deleted_form')[0].reset();
               table.ajax.reload();
            }
          });
        });
    });

</script>

@endsection