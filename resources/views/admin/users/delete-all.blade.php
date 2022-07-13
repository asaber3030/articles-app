@extends('layouts.admin')

@section('title', 'Delete All Users')

@section('content')

  <div class="section">
    <h1 class="heading _300"><i class="fas fa-fw fa-trash"></i> Delete All Users </h1>
    <div class="confirmation-message">
      <img src="{{ asset('icons/delete.svg') }}" alt="">
      <h2>By Deleting all users there's no one of current users can log in again</h2>
      <p><i class="fas fa-fw fa-info-circle mr-5"></i> Note: You can restore them later!</p>
      <form method="post">
        @csrf
        <button class="ui button red"><i class="fas fa-fw fa-trash"></i> Delete</button>
        <a class="ui button" href="{{ route('admin.users') }}"><i class="fas fa-fw fa-times"></i> Cancel</a>
      </form>
    </div>
  </div>

@endsection
