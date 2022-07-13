@extends('layouts.user')
@section('title', 'Profile')
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <div class="public-profile second-section">

    <div class="links">
      <div class="link" goto="{{ route('profile.articles') }}">
        <img src="{{ asset('icons/article.png') }}" alt="">
        <h2>My Articles</h2>
      </div>
      <div class="link" goto="{{ route('profile.courses') }}">
        <img src="{{ asset('icons/online-course.png') }}" alt="">
        <h2>My Courses</h2>
      </div>
      <div class="link" goto="{{ route('profile.howto') }}">
        <img src="{{ asset('icons/how.png') }}" alt="">
        <h2>My Steps Articles</h2>
      </div>
      <div class="link" goto="{{ route('profile.courses.my-enrolls') }}">
        <img src="{{ asset('icons/enroll.png') }}" alt="">
        <h2>My Enrolled Courses</h2>
      </div>
      <div class="link" goto="{{ route('profile.activity') }}">
        <img src="{{ asset('icons/activity.png') }}" alt="">
        <h2>My Activity</h2>
      </div>
      <div class="link" goto="{{ route('profile.articles') }}">
        <img src="{{ asset('icons/delete-account.png') }}" alt="">
        <h2>My Articles</h2>
      </div>
    </div>

    </div>

  </div>


@endsection
