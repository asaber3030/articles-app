@extends('layouts.admin')
@section('content')
  <div class="error-404">
    <img src="{{ asset('icons/404.png') }}" alt="">
    <h1>404 - Not Found</h1>
    <p>The requested url  <i>"{{ request()->url() }}"</i> doesn't exist</p>
    <a href="{{ redirect()->back() }}" class="ui button blue">Go Back</a>
  </div>
@endsection
