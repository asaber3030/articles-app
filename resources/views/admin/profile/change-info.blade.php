@extends('layouts.admin')
@section('title', 'Profile | Change Personal Information')
@section('add-remove', 'remove-padding-content')
@section('content')
  @php
    use App\Models\Admin\Admin;
  @endphp

  <div class="admin-profile">

    <div class="profile-top">
      <div class="left-content">
        <div class="top">
          <div class="img" goto="{{ route('admin.change.picture') }}"><img src="{{ asset(Admin::picture()) }}" alt="My Picture"></div>
          <div class="text">
            <h2>{{ Admin::fullname() }}</h2>
            <span>{{ '@' . Admin::username() }}</span>
          </div>
        </div>
        <div class="bottom">
          <span class="label"><i class="fas fa-fw fa-newspaper"></i> 3  Articles</span>
          <span class="label"><i class="fas fa-fw fa-play"></i> 3  Courses</span>
          <span class="label"><i class="fas fa-fw fa-tasks"></i> 3  Steps</span>
        </div>
      </div>
      <div class="right-content">
        <span><i class="fas fa-fw fa-clock"></i> Last Update {{ date('d M, Y', strtotime(Admin::admin()->updated_at)) }}</span>
        <span><i class="fas fa-fw fa-clock"></i> Created at {{ date('d M, Y', strtotime(Admin::admin()->created_at)) }}</span>
        <span><i class="fas fa-fw fa-clock"></i> {{ count(\App\Models\Admin\AdminActivity::current_admin_activity()) }} Total Activities</span>
      </div>
    </div>

    @include('admin.profile.tabs')

    <div class="content profile-change-info">
      <div class="form">
        <h1>Change Personal Information</h1>
        <form method="post" class="form ui">
          @csrf
          <div class="field ui">
            <label>Username</label>
            <input type="text" name="admin_username" value="{{ Admin::username() }}">
            @error('admin_username') <span class="red-c">{{ $message }}</span> @enderror
          </div>
          <div class="fields two">
            <div class="field ui">
              <label>Firstname</label>
              <input type="text" name="admin_firstname" value="{{ Admin::firstname() }}">
              @error('admin_firstname') <span class="red-c">{{ $message }}</span> @enderror
            </div>
            <div class="field ui">
              <label>Lastname</label>
              <input type="text" name="admin_lastname" value="{{ Admin::lastname() }}">
              @error('admin_lastname') <span class="red-c">{{ $message }}</span> @enderror
            </div>
          </div>
          <div class="field ui">
            <label>Phone</label>
            <input type="text" name="admin_phone" value="{{ Admin::phone() }}">
            @error('admin_phone') <span class="red-c">{{ $message }}</span> @enderror
          </div>

          <div class="field ui">
            <label>E-mail Address</label>
            <input type="text" name="admin_email" value="{{ Admin::email() }}">
            @error('admin_email') <span class="red-c">{{ $message }}</span> @enderror
          </div>
          <button type="submit" class="button ui blue"><i class="fas fa-fw fa-wrench"></i> Update</button>
          <button class="button ui" type="button" goto="{{ route('admin.profile') }}"><i class="fas fa-fw fa-home"></i> Profile</button>
        </form>
      </div>
    </div>
  </div>
@endsection
