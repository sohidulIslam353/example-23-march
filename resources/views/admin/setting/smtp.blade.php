@extends('layouts.admin')

@section('admin_content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">SMTP Mail</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">SMTP Mail Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('smtp.setting.update')}}" method="Post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mail Mailer</label>
                    <input type="hidden" name="types[]" value="MAIL_MAILER">
                    <input type="text" class="form-control" name="MAIL_MAILER" value="{{env('MAIL_MAILER')}}" placeholder="Mail Lailer Example: smtp">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mail Host</label>
                    <input type="hidden" name="types[]" value="MAIL_HOST">
                    <input type="text" class="form-control" name="MAIL_HOST" value="{{env('MAIL_HOST')}}"  placeholder="Mail Host">
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Mail Port</label>
                    <input type="hidden" name="types[]" value="MAIL_PORT">
                    <input type="text" class="form-control" name="MAIL_PORT" value="{{env('MAIL_PORT')}}" placeholder="Mail Port Example: 2525">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mail Username</label>
                    <input type="hidden" name="types[]" value="MAIL_USERNAME">
                    <input type="text" class="form-control" name="MAIL_USERNAME" value="{{env('MAIL_USERNAME')}}" placeholder="Mail Username">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mail Password</label>
                    <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                    <input type="text" class="form-control" name="MAIL_PASSWORD" value="{{env('MAIL_PASSWORD')}}"  placeholder="Mail Password">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
