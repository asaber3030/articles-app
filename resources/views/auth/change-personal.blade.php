@extends('layouts.user')
@section('title', 'Contact Information')
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <div class="add-section change-profile-password second-section">

      <h1 class="heading"><i class="fas fa-fw fa-user"></i> Personal Information</h1>

      <form method="post" class="add-article-form ui form" enctype="multipart/form-data">
        @csrf

        <div class="two fields">
          <div class="field">
            <label>Firstname</label>
            <input type="text" name="firstname" value="{{ firstname() }}">
            @error('email') <span class="error">{{ $message }}</span> @enderror
          </div>

          <div class="field">
            <label>Lastname</label>
            <input type="text" name="lastname" value="{{ lastname() }}">
            @error('lastname') <span class="error">{{ $message }}</span> @enderror
          </div>
        </div>

        <div class="field">
          <label>Username</label>
          <input type="text" name="username" value="{{ username() }}">
          @error('username') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>Job Title</label>
          <input type="text" name="job_title" value="{{ job_title() }}">
          @error('job_title') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>Skills (Separate them with , like: HTML,CSS,C,C++,Python)</label>
          <input type="text" name="skills" value="{{ skills() }}">
          @error('skills') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>Bio</label>
          <textarea name="bio">{{ bio() }}</textarea>
          @error('bio') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="ui button primary"><i class="fas fa-fw fa-wrench"></i> Change</button>

      </form>

    </div>

  </div>

@endsection

