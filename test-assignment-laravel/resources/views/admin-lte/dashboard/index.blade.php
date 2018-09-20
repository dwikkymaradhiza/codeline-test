@extends('admin-lte.layouts.template')

@section('content')
<div class="container">
  @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
  @endif

  You are logged in! Visit your site <a target="_blank" href="{{ route('films') }}">Here</a>.
</div>
@endsection
