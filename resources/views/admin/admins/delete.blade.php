@extends('layouts.admin')

@section('title', 'Admins | Delete')

@section('content')

  <div class="section">
    <h1 class="heading _300"><i class="fas fa-fw fa-trash"></i> Delete Admin <strong class="code">"{{ '@' . $admin->admin_username }}" ?</strong></h1>
    <div class="confirmation-message">
      <img src="{{ asset('icons/delete.svg') }}" alt="">
      <h2>Are you sure that you want to delete this admin forever?</h2>
      <p><i class="fas fa-fw fa-info-circle mr-5"></i> Note: You can't restore this admin again!</p>
      <form method="post">
        @csrf
        <button class="ui button red"><i class="fas fa-fw fa-trash"></i> Delete</button>
        <a class="ui button" href="{{ route('admin.users') }}"><i class="fas fa-fw fa-times"></i> Cancel</a>
      </form>
    </div>
  </div>

@endsection
