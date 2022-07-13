@extends('layouts.admin')

@section('title', 'Update Admin')

@section('content')
  <div class="section update-admin-page" style="width: 50%">
    <h1 class="heading">Update Admin: <span class="code">{{ '@' . $admin->admin_username }}</span></h1>
    <form method="post" class="form ui">
      @csrf
      <div class="field ui">
        <label>Username</label>
        <input name="admin_username" type="text" value="{{ $admin->admin_username }}">
        @error('admin_username') <span class="red-c">{{ $message }}</span> @enderror
      </div>
      <div class="field ui">
        <label>Firstname</label>
        <input name="admin_firstname" type="text" value="{{ $admin->admin_firstname }}">
        @error('admin_firstname') <span class="red-c">{{ $message }}</span> @enderror
      </div>
      <div class="field ui">
        <label>Last name</label>
        <input name="admin_lastname" type="text" value="{{ $admin->admin_lastname }}">
        @error('admin_lastname') <span class="red-c">{{ $message }}</span> @enderror
      </div>
      <div class="field ui">
        <label>E-mail</label>
        <input name="admin_email" type="email" value="{{ $admin->admin_email }}">
        @error('admin_admin_email') <span class="red-c">{{ $message }}</span> @enderror
      </div>
      <div class="checkbox ui">
        <input id="ad_role" name="admin_role" type="checkbox" @if ($admin->admin_role == 2) checked @endif >
        <label style="cursor: pointer; user-select: none" for="ad_role">Super Admin?</label>
      </div>
      <div class="clearfix"></div>
      <button class="ui button blue" style="margin-top: 15px">Submit</button>
    </form>
  </div>
@endsection
