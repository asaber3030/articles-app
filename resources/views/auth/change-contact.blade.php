@extends('layouts.user')
@section('title', 'Contact Information')
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <div class="add-section change-profile-password second-section">

      <h1 class="heading"><i class="fas fa-fw fa-user"></i> Contact Information</h1>

      <form method="post" class="add-article-form ui form" enctype="multipart/form-data">
        @csrf

        <div class="field">
          <label>E-mail Address</label>
          <input type="email" name="email" value="{{ email() }}">
          @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>Phone Number</label>
          <input type="text" name="phone" value="{{ phone() }}">
          @error('phone') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>Website</label>
          <input type="url" name="website" value="{{ website() }}">
          @error('website') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="ui button primary"><i class="fas fa-fw fa-wrench"></i> Change</button>

      </form>

    </div>

  </div>

@endsection

