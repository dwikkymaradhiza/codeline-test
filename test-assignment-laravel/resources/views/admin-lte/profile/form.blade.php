@extends('admin-lte.layouts.template')

@section('title')
<section class="content-header">
  <h1>
    Update Profile
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a class="active">Update Profile</a></li>
  </ol>
</section>
@endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<form role="form" method="POST" enctype="multipart/form-data" action="{{ route('profile.update') }}">
  <input name="_method" type="hidden" value="PUT">
  {{ csrf_field() }}
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Account Information</h3>
        </div>

        <div class="box-body">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="name" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{ $user->name or old('name') }}">
          </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ $user->email or old('email') }}">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="password_confirmation">Password Confirmation</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Password Confirmation">
          </div>
        </div>
      </div>
        <!-- /.box-body -->
      </div>
    </div>
    <!--/.col (left) -->
    <div class="box box-default">
      <div class="box-body">
          <button type="submit" class="pull-right btn btn-primary">Submit</button>
      </div>
    </div>
  <!--/.row -->
</form>
@endsection
