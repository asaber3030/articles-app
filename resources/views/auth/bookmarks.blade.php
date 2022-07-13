@extends('layouts.user')
@section('title', 'My Bookmarks')
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <livewire:user.all-favourites />

  </div>

@endsection
