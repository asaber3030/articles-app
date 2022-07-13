@extends('layouts.user')
@section('title', 'Profile Picture')
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <div class="add-section change-profile-password second-section">

      <h1 class="heading"><i class="fas fa-fw fa-user-lock"></i> Change Password</h1>

      <form method="post" class="add-article-form ui form" enctype="multipart/form-data">
        @csrf

        <div class="field">
          <label>Old Password</label>
          <input type="password" name="old_password">
          @error('old_password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>New Password</label>
          <input type="password" name="new_password">
          @error('new_password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="ui button primary"><i class="fas fa-fw fa-wrench"></i> Change My Password</button>

      </form>

    </div>

  </div>

@endsection

