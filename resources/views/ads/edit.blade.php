@extends('layouts.app')
@section('title', 'Modifier l’annonce')
@section('content')
  <h1>Modifier l’annonce</h1>
  <form action="{{ route('ads.update', $ad) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('ads._form')
    <button class="btn btn-primary">Mettre à jour</button>
  </form>
@endsection
