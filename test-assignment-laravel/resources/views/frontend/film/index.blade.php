@extends('frontend.layouts.template')

@section('content')
<div class="container-fluid">
  @foreach ($films as $k => $v)
  <div class="col-md-12">
    <div class="text-center">
      <a href="{{ route('films.detail', $v->slug) }}"><img class="img-thumbnail" src="{{ asset('/uploads/' . $v->photo) }}" /></a>
    </div>
    <h2><a href="{{ route('films.detail', $v->slug) }}">{{ $v->name }}</a></h2>
    <p>{{ $v->description }}</p>
    <strong>Rating</strong> : {{ $v->rating }} | <strong>Release Date</strong> : {{ $v->release_date }} | <strong>Genres</strong> :
    @foreach($v->genres as $kg => $vg)
      <span class="badge">{{ $vg->name }}</span>
    @endforeach
  </div>
  @endforeach
  <div class="col-md-12 text-center">{{ $films->links() }}</div>
</div>

@endsection