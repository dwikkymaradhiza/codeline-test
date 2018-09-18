@extends('admin-lte.layouts.template')

@section('title')
<section class="content-header">
  <h1>
    {{ isset($film) ? 'Update Film' : 'Create New Film' }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route('film.index') }}">Film</a></li>
    <li class="active">{{ isset($film) ? 'Update Film' : 'Create New Film' }}</li>
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

<form role="form" method="POST" enctype="multipart/form-data" action="{{ isset($film) ? route('film.update', ['film' => $film->id]) : route('film.store') }}">
  @if(isset($film))
    <input name="_method" type="hidden" value="PUT">
  @endif
  {{ csrf_field() }}
  <div class="row">
    <!-- left column -->
    <div class="col-md-12 col-xs-12">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{ $film->name or old('name') }}">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description">{{ $film->description or old('description') }}</textarea>
          </div>
          <div class="form-group">
              <label for="permissions">Genres</label>
              @foreach($genres as $val)
                <br />
                <input id="{{ $val->name }}" class="minimal" type="checkbox" name="genres[]" value="{{ $val->id }}" /> <label for="{{ $val->name }}" style="font-weight: normal">{{ $val->name }}</label>
              @endforeach
            </div>
          <div class="form-group">
            <label for="photo">Photo</label>
            @if(isset($film) && !empty($film->photo))
            <div class="input-group">
              <a href="{{ asset('uploads/'. $film->photo) }}">
                <img class="thumbnail" src="{{ asset('uploads/220_326_'. $film->photo) }}" />
              </a>
            </div>
            @endif
            <div class="input-group">
                <input required readonly type="text" id="photo_path" class="form-control" placeholder="Browse...">
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button" id="photo_browser">
                  <i class="fa fa-search"></i> Browse</button>
                </span>
            </div>
            <input type="file" class="hidden" id="photo" name="photo">
            <p class="help-block">Format file allowed : png, jpg.</p>
          </div>
          <div class="form-group">
            <label for="rating">Rating</label>
            <input type="number" name="rating" class="form-control" id="rating" value="{{ $film->rating or old('rating') }}">
          </div>
          <div class="form-group">
            <label for="release_date">Release Date</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" readonly name="release_date" class="form-control pull-right" id="release_date"  value="{{ $film->release_date or old('release_date') }}">
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <div class="col-md-12">
      <!--/.col (left) -->
        <div class="box box-default">
          <div class="box-body">
              <a href="{{ route('film.index') }}" class="btn btn-default">&laquo; Back</a>
              <button type="submit" class="pull-right btn btn-primary">Submit</button>
          </div>
        </div>
      <!--/.row -->
    </div>
  </div>
</form>

@endsection

@section('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset("/bower_components/select2/dist/css/select2.min.css") }}">
<!-- Datepicker -->
<link rel="stylesheet" href="{{ asset("/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css") }}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/iCheck/all.css") }}">
@endsection

@section('scripts')
<!-- iCheck -->
<script src="{{ asset("/bower_components/admin-lte/plugins/iCheck/icheck.min.js") }}"></script>
<!-- Select2 -->
<script src="{{ asset("/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
<!-- Datepicker -->
<script src="{{ asset("/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js") }}"></script>

<script>
$(document).ready(function() {
  //------------- CUSTOM PHOTO ---------------//
  $('#photo_browser').on('click', function(e){
      e.preventDefault();
      $('#photo').click();
  });

  $('#photo').on('change', function(){
      $('#photo_path').val($(this).val());
  });

  $('#photo_path').on('click', function(){
      $('#photo_browser').click();
  });

  //----------- DATEPICKER -----------//
  $('#release_date').datepicker({
    autoclose: true
  });

  //------------ MINIMAL ------------//
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
  });
});
</script>
@endsection
