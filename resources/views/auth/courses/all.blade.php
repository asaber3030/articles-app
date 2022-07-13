@extends('layouts.user')
@section('title', 'Profile')
@section('content')

<div class="profile-page">

  @include('auth.sidebar')

  <livewire:user.courses-all />

</div>

@endsection
