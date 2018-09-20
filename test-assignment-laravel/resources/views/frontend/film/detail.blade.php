@extends('frontend.layouts.template')

@section('content')
<div class="container-fluid">
  <div class="col-md-12">
    <div class="text-center">
      <img class="img-thumbnail" src="{{ asset('/uploads/' . $film->photo) }}" />
    </div>
    <h2>{{ $film->name }}</h2>
    <p>{{ $film->description }}</p>
    <strong>Rating</strong> : {{ $film->rating }} | <strong>Release Date</strong> : {{ $film->release_date }} | <strong>Genres</strong> :
    @foreach($film->genres as $kg => $vg)
      <span class="badge">{{ $vg->name }}</span>
    @endforeach
  </div>
  @include('frontend.film.comment')
</div>

@endsection