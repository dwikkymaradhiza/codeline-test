@extends('admin-lte.layouts.template')

@section('content')
<div class="container">
  @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
  @endif

  You are logged in!
</div>
@endsection
