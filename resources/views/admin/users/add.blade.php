@extends('layouts.admin')

@section('title', 'Add New User')

@section('content')
  <div class="section add-new-user-page select-div-related-actions">
    <div class="content">
      <div class="left-c">
        <h1 class="heading"><i class="fas fa-fw fa-user-plus"></i> New User</h1>
        <form method="post" class="form ui">
          @csrf
          <div class="field ui">
            <label>Username</label>
            <input name="username" type="text" value="{{ old('username') }}">
            @error('username') <span class="red-c">{{ $message }}</span> @enderror
          </div>
          <div class="field ui">
            <label>Firstname</label>
            <input name="firstname" type="text" value="{{ old('firstname') }}">
            @error('firstname') <span class="red-c">{{ $message }}</span> @enderror
          </div>
          <div class="field ui">
            <label>Last name</label>
            <input name="lastname" type="text" value="{{ old('lastname') }}">
            @error('lastname') <span class="red-c">{{ $message }}</span> @enderror
          </div>
          <div class="field ui">
            <label>E-mail</label>
            <input name="email" type="email" value="{{ old('email') }}">
            @error('email') <span class="red-c">{{ $message }}</span> @enderror
          </div>
          <div class="field ui">
            <label>Password</label>
            <input name="password" type="text" value="{{ old('password') }}">
            @error('password') <span class="red-c">{{ $message }}</span> @enderror
          </div>
          <button class="ui button blue"><i class="fas fa-fw fa-check"></i> Submit</button>
          <button class="ui button" goto="{{ route('admin.users') }}" type="button"><i class="fas fa-fw fa-times"></i> Cancel</button>
        </form>
      </div>
      <div class="right-c">
        <h1>Related Actions</h1>
        <div class="related-actions">
          <div class="action" goto="{{ route('admin.articles.add') }}">
            <div class="icon"><i class="fas fa-fw fa-plus"></i></div>
            <div class="text">New Article</div>
          </div>
          <div class="action" goto="{{ route('admin.howto.add') }}">
            <div class="icon"><i class="fas fa-fw fa-plus"></i></div>
            <div class="text">New Step Article</div>
          </div>
          <div class="action" goto="{{ route('admin.courses.add') }}">
            <div class="icon"><i class="fas fa-plus"></i></div>
            <div class="text">New Course</div>
          </div>
          <div class="action" goto="{{ route('admin.admins.add') }}">
            <div class="icon"><i class="fas fa-fw fa-plus"></i></div>
            <div class="text">New Admin</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
