@extends('layouts.admin')

@section('title', 'Delete All Articles')

@section('content')

  <div class="section">
    <h1 class="heading _300"><i class="fas fa-fw fa-trash"></i> Delete All Articles </h1>
    <div class="confirmation-message">
      <img src="{{ asset('icons/delete.svg') }}" alt="">
      <h2>By Deleting all articles there's no articles will be displayed for user</h2>
      <p><i class="fas fa-fw fa-info-circle mr-5"></i> Note: You can restore them later!</p>
      <form method="post">
        @csrf
        <button class="ui button red"><i class="fas fa-fw fa-trash"></i> Delete</button>
        <a class="ui button" href="{{ route('admin.articles') }}"><i class="fas fa-fw fa-times"></i> Cancel</a>
      </form>
    </div>
  </div>

@endsection
