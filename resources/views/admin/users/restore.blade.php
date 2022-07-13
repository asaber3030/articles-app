@extends('layouts.admin')

@section('title', 'Restore This User')

@section('content')

  <div class="section">
    <h1 class="heading _300"><i class="fas fa-fw fa-trash-restore"></i> Restore User <strong>"{{ '@' . $user->username }}" ?</strong></h1>
    <div class="confirmation-message">
      <img src="{{ asset('icons/restore.svg') }}" alt="">
      <h2>Are you sure that you want to restore this user again?</h2>
      <p><i class="fas fa-fw fa-info-circle mr-5"></i> Note: This user can log in and publish new articles again by applying this action</p>
      <form method="post">
        @csrf
        <button class="ui button primary"><i class="fas fa-fw fa-trash-restore"></i> Restore</button>
        <a class="ui button" href="{{ route('admin.users') }}"><i class="fas fa-fw fa-times"></i> Cancel</a>
      </form>
    </div>
  </div>

@endsection
