@extends('layouts.app')
@section('title', 'Publier une annonce')
@section('content')
  <h1>Publier une annonce</h1>
  <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('ads._form')
    <button class="btn btn-success">Publier</button>
  </form>
@endsection
