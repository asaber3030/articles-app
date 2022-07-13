@extends('layouts.user')
@section('title', 'Profile')
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <div class="delete-account second-section">

      <h1><i class="fas fa-fw fa-exclamation-triangle"></i> Delete My Account!</h1>

      <div class="info">
        <img src="{{ asset('icons/delete-account.png') }}" alt="">
        <p class="info">
          Once you delete your account you cannot restore it again forever!<br>
          All your data will be deleted once you submit delete button including [ Articles, Courses, Videos, Uploaded PDFs, Activity ] will be erased.
        </p>
      </div>

      <div class="submit-data">
        <form method="post" class="ui form">
          @csrf
          <div class="field">
            <label>Password</label>
            <input type="password" name="password" placeholder="Current Password">
            @error('password') <span class="red-c">{{ $message }}</span> @enderror
          </div>
          <div class="field">
            <label>Username</label>
            <input type="text" name="username" placeholder="Type your username: {{ '@' . username() }}">
            @error('password') <span class="red-c">{{ $message }}</span> @enderror
          </div>
          <button class="ui button" open-model="#my-model-submit" type="button"><i class="fas fa-fw fa-trash"></i> Delete Account</button>
          <button style="display: none;" id="submitForm" type="submit">Su</button>
          <div class="ui modal tiny" id="my-model-submit">
            <div class="header"><i class="fas fa-fw fa-trash"></i> Delete My Account!</div>
            <div class="content">
              <p>All your data will be deleted once you submit delete button including [ Articles, Courses, Videos, Uploaded PDFs, Activity ] will be erased.</p>
            </div>
            <div class="actions">
              <button type="submit" id="submit-data" class="ui red button"><i class="fas fa-fw fa-check"></i> Approve</button>
              <button type="button" class="ui button approve blue"> <i class="fas fa-fw fa-times"></i> Cancel</button>
            </div>
          </div>
        </form>
      </div>

    </div>

  </div>

@endsection
