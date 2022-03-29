@extends('layouts.admin')
@section('admin_content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Products For Campaign</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{ route('campaign.product.list',$campaign_id) }}" class="btn btn-primary"> Product List</a>
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
                <h3 class="card-title">All Products For Campaign</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Name</th>
                      <th>Image</th>
                      <th>Code</th>
                      <th>Category</th>
                      <th>Brand</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                   @foreach($products as $key=>$row) 
                   @php 
                     $exist=DB::table('campaign_product')->where('campaign_id',$campaign_id)->where('product_id',$row->id)->first();
                   @endphp	
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $row->name }}</td>
                      <td><img src="{{ asset('public/files/product/'.$row->thumbnail) }}" height="32" width="32"></td>
                      <td>{{ $row->code }}</td>
                      <td>{{ $row->category_name }}</td>
                      <td>{{ $row->brand_name }}</td>
                      <td>{{ $row->selling_price }}</td>
                      <td>
                      	@if($exist)
                      	@else
                      	<a href="{{ route('add.product.to.campaign',[$row->id,$campaign_id]) }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></a>
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
</section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection