@extends('layouts.admin')

@section('title', 'Restore All Users')

@section('content')

  <div class="section">
    <h1 class="heading _300"><i class="fas fa-fw fa-trash"></i> Restore All Articles </h1>
    <div class="confirmation-message">
      <img src="{{ asset('icons/delete.svg') }}" alt="">
      <h2>By Restore all articles will be available for user</h2>
      <p><i class="fas fa-fw fa-info-circle mr-5"></i> Note: You can delete them later!</p>
      <form method="post">
        @csrf
        <button class="ui button white"><i class="fas fa-fw fa-trash-restore"></i> Restore</button>
        <a class="ui button primary" href="{{ route('admin.articles') }}"><i class="fas fa-fw fa-times"></i> Cancel</a>
      </form>
    </div>
  </div>

@endsection
