@extends('layouts.user')
@section('title', 'Profile Picture')
@section('content')

  <div class="profile-page">
    @include('auth.sidebar')

    <div class="add-section change-profile-picture second-section">
      <h1 class="heading"><i class="fas fa-fw fa-image"></i> Change My Profile Picture</h1>

      <form method="post" class="add-article-form ui form" enctype="multipart/form-data">
        @csrf

        <div class="field">
          <label>New Profile Picture</label>
          <div class="field-picture">

            <input type="file" name="new_picture">
            <h3>
              <img src="{{ asset('icons/upload.png') }}" alt="">
              Choose New Picture!
            </h3>

          </div>
          @error('new_picture') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="ui button primary"><i class="fas fa-fw fa-plus"></i> Change</button>

      </form>

    </div>

  </div>

@endsection

