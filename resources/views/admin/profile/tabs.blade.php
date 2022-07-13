<div class="tabs-part">
  <ul>
    <li><a href="{{ route('admin.profile') }}" @if (request()->is('admin/profile')) class="active" @endif><i class="fas fa-fw fa-home"></i> Profile</a></li>
    <li><a href="{{ route('admin.change.password') }}" @if (request()->is('admin/profile/change-password')) class="active" @endif><i class="fas fa-fw fa-lock"></i> Change Password</a></li>
    <li><a href="{{ route('admin.change.info') }}" @if (request()->is('admin/profile/change-info')) class="active" @endif><i class="fas fa-fw fa-id-card"></i> Change Personal Information</a> </li>
    <li><a href="{{ route('admin.change.picture') }}" @if (request()->is('admin/profile/change-picture')) class="active" @endif><i class="fas fa-fw fa-image"></i> Change Profile Picture</a></li>
    <li><a href="{{ route('admin.activities') }}" @if (request()->is('admin/profile/activities')) class="active" @endif><i class="fas fa-fw fa-chart-line"></i> Activities</a></li>
  </ul>
</div>

@if (session()->has('msg'))
  <div class="alert">{{ session()->get('msg') }}</div>

@endif
