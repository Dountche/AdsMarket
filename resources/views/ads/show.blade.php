@extends('layouts.app')
@section('title', $ad->title)
@section('content')
  <div class="row">
    <div class="col-md-8">
      <h1>{{ $ad->title }}</h1>
      @if ($ad->photos->count())
        <div id="carouselAd" class="carousel slide mb-4" data-bs-ride="carousel">
          <div class="carousel-inner">
            @foreach ($ad->photos as $i => $photo)
              <div class="carousel-item @if($i==0) active @endif">
                <img src="{{ asset('storage/' . $photo->path) }}" class="d-block w-100" alt>
              </div>
            @endforeach
          </div>
          <button class="carousel-control-prev" data-bs-target="#carouselAd" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" data-bs-target="#carouselAd" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>
      @endif
      <p>{{ $ad->description }}</p>
      @if ($ad->price)
        <p class="h4 text-success">{{ number_format($ad->price,2,',',' ') }} €</p>
      @endif
    </div>
    <div class="col-md-4">
      <div class="card p-3">
        <h5>Vendu par</h5>
        <p><strong>{{ $ad->user->name }}</strong></p>
        @auth
          @can('update', $ad)
            <a href="{{ route('ads.edit', $ad) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
          @endcan
          @can('delete', $ad)
            <form action="{{ route('ads.destroy', $ad) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ?')">Supprimer</button>
            </form>
          @endcan
        @endauth
      </div>
    </div>
  </div>
@endsection
