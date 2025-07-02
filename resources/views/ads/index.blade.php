@extends('layouts.app')
@section('title', 'Toutes les annonces')
@section('content')
  <h1>Toutes les annonces</h1>
  <div class="row">
    @foreach ($ads as $ad)
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          @if ($ad->photos->first())
            <img src="{{ asset('storage/' . $ad->photos->first()->path) }}" class="card-img-top" alt>
          @endif
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $ad->title }}</h5>
            <p class="card-text">{{ Str::limit($ad->description, 80) }}</p>
            @if ($ad->price)
              <p class="fw-bold">{{ number_format($ad->price,2,',',' ') }} €</p>
            @endif
            <a href="{{ route('ads.show', $ad) }}" class="btn btn-outline-primary mt-auto">Voir</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="d-flex justify-content-center">
    {{ $ads->links() }}
  </div>
@endsection
