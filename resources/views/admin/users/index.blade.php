@extends('layouts.admin')
@section('title', 'Users')
@section('content')
  <div class="users-page section">
    <h1 class="heading"><i class="fas fa-fw fa-users mr-10"></i> Users</h1>
    <livewire:admin.users.display-users />
  </div>
@endsection

@section('scripts')

@endsection
