@php
  Use App\Models\User;
  $user = auth()->user();
@endphp

<div class="sidebar">
  <div class="display-name">
    <img goto="{{ route('profile.change.picture') }}" src="{{ asset(picture()) }}" alt="User Picture" class="{{ picture() === 'icons/user.svg' ? 'inverse-img' : '' }}">
    <h1>
      {{ fullname() }}
      <span>{{ '@' . username() . id() }}</span>
    </h1>
  </div>

  <ul class="list">
    <li><a href="{{ route('profile') }}" @if (request()->is('profile')) class='active' @endif><i class="fas fa-fw fa-user"></i> My Profile</a></li>
    <li><a href="{{ route('profile.change.personal') }}" @if (request()->is('profile/personal-information')) class='active' @endif><i class="fas fa-fw fa-wrench"></i> Personal Information</a></li>
    <li><a href="{{ route('profile.change.contact') }}" @if (request()->is('profile/contact-information')) class='active' @endif><i class="fas fa-fw fa-id-card"></i> Contact Information</a></li>
    <li><a href="{{ route('profile.change.picture') }}" @if (request()->is('profile/picture')) class='active' @endif><i class="fas fa-fw fa-image"></i> Profile Picture</a></li>
    <li><a href="{{ route('profile.change.password') }}" @if (request()->is('profile/password')) class='active' @endif><i class="fas fa-fw fa-lock"></i> Change Password</a></li>
  </ul>
  <div class="separator"></div>
  <ul class="list">
    <li><a href="{{ route('profile.articles') }}" @if (request()->is('profile/articles')) class='active' @endif><i class="fas fa-fw fa-newspaper"></i> My Articles <span class="badge">{{ User::count_articles() }}</span></a></li>
    <li><a href="{{ route('profile.courses') }}" @if (request()->is('profile/courses')) class='active' @endif><i class="fas fa-fw fa-play"></i> My Courses <span class="badge">{{ User::count_courses() }}</span></a></li>
    <li><a href="{{ route('profile.howto') }}" @if (request()->is('profile/how-to')) class='active' @endif><i class="fas fa-fw fa-tasks"></i> My Step Articles <span class="badge">{{ User::count_steps() }}</span></a></li>
    <li><a href="{{ route('profile.bookmarks') }}" @if (request()->is('profile/bookmarks')) class='active' @endif><i class="fas fa-fw fa-bookmark"></i> My Bookmarks <span class="badge">{{ count_my_bookmarks() }}</span></a></li>
  </ul>
  <div class="separator"></div>
  <ul class="list">
    <li><a href="{{ route('profile.articles.add') }}" @if (request()->is('profile/articles/add')) class='active' @endif><i class="fas fa-fw fa-plus"></i> New Article</a></li>
    <li><a href="{{ route('profile.courses.add') }}" @if (request()->is('profile/courses/add')) class='active' @endif><i class="fas fa-fw fa-plus"></i> New Course</a></li>
    <li><a href="{{ route('profile.howto.add') }}" @if (request()->is('profile/how-to/add')) class='active' @endif><i class="fas fa-fw fa-plus"></i> New How to Article</a></li>
  </ul>
  <div class="separator"></div>
  <ul class="list">
    <li><a href="{{ route('profile.courses.my-enrolls') }}" @if (request()->is('profile/courses/enrolled')) class='active' @endif><i class="fas fa-fw fa-check"></i> My Enrolled Courses</a></li>
    <li><a href="{{ route('profile.activity') }}" @if (request()->is('profile/activity')) class='active' @endif><i class="fas fa-fw fa-chart-line"></i> My Activity</a></li>
    <li><a href="{{ route('profile.delete') }}" style="color: #bb4b4b;"><i class="fas fa-fw fa-trash"></i> Delete My Account</a></li>
  </ul>
</div>
