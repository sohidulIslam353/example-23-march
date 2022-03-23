@extends('layouts.admin')
@section('admin_content')



  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Role</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update role</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <form action="{{ route('update.role') }}" method="post" >
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
       	<div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update  Role</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="exampleInputEmail1">Employee Name <span class="text-danger">*</span> </label>
                      <input type="text" class="form-control" name="name" value="{{ $data->name }}"  required="">
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="exampleInputPassword1">Employee Email <span class="text-danger">*</span> </label>
                      <input type="email" class="form-control" value="{{ $data->email }}" name="email" required="">
                    </div>
                  </div>

                  <div class="row">
                  	<div class="col-3">
                        <h6>Category</h6>
                       <input type="checkbox" name="category" value="1" @if($data->category==1) checked @endif >
                    </div>
                    <div class="col-3">
                        <h6>Product</h6>
                       <input type="checkbox" name="product" value="1"  @if($data->product==1) checked @endif>
                    </div>
                    <div class="col-3">
                        <h6>Offer</h6>
                       <input type="checkbox" name="offer" value="1" @if($data->offer==1) checked @endif>
                    </div>
                    <div class="col-3">
                        <h6>Order</h6>
                       <input type="checkbox" name="order" value="1"  @if($data->order==1) checked @endif>
                    </div>
                  </div>

                  <div class="row">
                  	<div class="col-3">
                        <h6>Pickuppoint</h6>
                       <input type="checkbox" name="pickup" value="1" @if($data->pickup==1) checked @endif >
                    </div>
                    <div class="col-3">
                        <h6>Tickets</h6>
                       <input type="checkbox" name="ticket" value="1"  @if($data->ticket==1) checked @endif>
                    </div>
                    <div class="col-3">
                        <h6>Contact</h6>
                       <input type="checkbox" name="contact" value="1" @if($data->contact==1) checked @endif>
                    </div>
                    <div class="col-3">
                        <h6>Report</h6>
                       <input type="checkbox" name="report" value="1"  @if($data->report==1) checked @endif>
                    </div>
                  </div>

                  <div class="row">
                  	<div class="col-3">
                        <h6>Setting</h6>
                       <input type="checkbox" name="setting" value="1" @if($data->setting==1) checked @endif >
                    </div>
                    <div class="col-3">
                        <h6>Userrole</h6>
                       <input type="checkbox" name="userrole" value="1" @if($data->userrole==1) checked @endif>
                    </div>
                    <div class="col-3">
                        <h6>blog</h6>
                       <input type="checkbox" name="blog" value="1" @if($data->blog==1) checked @endif>
                    </div>
                 
                  </div>
                    
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <button class="btn btn-info ml-2" type="submit">Update</button>
           </div>
            <!-- /.card -->

           
         </div>
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection