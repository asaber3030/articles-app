@extends('layouts.admin')

@section('title', 'Admins | New Admin')

@section('content')

  <div class="section add-new-admin-page select-div-related-actions">
    <div class="content">
      <div class="left-c">
        <h1 class="heading">Add New Admin</h1>
        <form method="post" autocomplete="off" class="form ui">
          @csrf
          <div class="field ui">
            <label>Username</label>
            <input name="admin_username" type="text" value="{{ old('admin_username') }}">
            @error('admin_username') <span class="red-c">{{ $message }}</span> @enderror
          </div>
          <div class="field ui">
            <label>Firstname</label>
            <input name="admin_firstname" type="text" value="{{ old('admin_firstname') }}">
            @error('admin_firstname') <span class="red-c">{{ $message }}</span> @enderror
          </div>
          <div class="field ui">
            <label>Last name</label>
            <input name="admin_lastname" type="text" value="{{ old('admin_lastname') }}">
            @error('admin_lastname') <span class="red-c">{{ $message }}</span> @enderror
          </div>
          <div class="field ui">
            <label>E-mail</label>
            <input name="admin_email" type="email" value="{{ old('admin_email') }}">
            @error('admin_email') <span class="red-c">{{ $message }}</span> @enderror
          </div>
          <div class="field ui">
            <label>Password</label>
            <input name="admin_password" type="text" value="{{ old('admin_password') }}">
            @error('admin_password') <span class="red-c">{{ $message }}</span> @enderror
          </div>
          <button class="ui button blue"><i class="fas fa-fw fa-check"></i> Submit</button>
          <button type="button" class="ui button" goto="{{ route('admin.admins') }}"><i class="fas fa-fw fa-times"></i> Cancel</button>
        </form>
      </div>
      <div class="right-c">
        <h1>Related Actions</h1>
        <div class="related-actions">
          <div class="action" goto="{{ route('admin.articles.add') }}">
            <div class="icon"><i class="fas fa-plus"></i></div>
            <div class="text">Add New Article</div>
          </div>
          <div class="action" goto="{{ route('admin.courses.add') }}">
            <div class="icon"><i class="fas fa-fw fa-plus"></i></div>
            <div class="text">Add New Course</div>
          </div>
          <div class="action" goto="{{ route('admin.users.add') }}">
            <div class="icon"><i class="fas fa-fw fa-plus"></i></div>
            <div class="text">Add New User</div>
          </div>
          <div class="action" goto="{{ route('admin.howto.add') }}">
            <div class="icon"><i class="fas fa-fw fa-plus"></i></div>
            <div class="text">Add New Step Article</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
