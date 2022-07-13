@extends('layouts.admin')
@section('title', 'Admins')
@section('content')
  <div class="users-page section">
    <h1 class="heading"><i class="fas fa-fw fa-user-lock mr-10"></i> Admins</h1>
    <livewire:admin.admins.display-admins />
  </div>
@endsection
