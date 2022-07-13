@extends('layouts.admin')

@section('content')

  <div class="dashboard-page section">

    <h1 class="heading">Dashboard</h1>

    <div class="first-part">

      <div class="services">

        <h2><i class="fas fa-fw fa-hashtag mr-8"></i> Services</h2>

        <div class="services-container">

          <div class="service">
            <div style="background-color: #2980b9" class="icon"><i style="color: #7d98cf" class="fas fa-fw fa-users"></i></div>
            <h4><span>{{ count(App\Models\Admin\Users::all()) }}</span> Users</h4>
          </div>

          <div class="service">
            <div style="background-color: #429d7b" class="icon"><i style="color: #7d98cf" class="fas fa-fw fa-user-lock"></i></div>
            <h4><span>{{ count(App\Models\Admin\Admin::all()) }}</span> Admins</h4>
          </div>

          <div class="service">
            <div style="background-color: #2980b9" class="icon"><i style="color: #7d98cf" class="fas fa-fw fa-newspaper"></i></div>
            <h4><span>{{ count(App\Models\Admin\Articles::all()) }}</span> Articles</h4>
          </div>

          <div class="service">
            <div style="background-color: #202838" class="icon"><i style="color: #7d98cf" class="fas fa-fw fa-play"></i></div>
            <h4><span>{{ count(App\Models\Admin\Courses::all()) }}</span> Courses</h4>
          </div>

          <div class="service">
            <div style="background-color: #2b29b9" class="icon"><i style="color: #7d98cf" class="fas fa-fw fa-tasks"></i></div>
            <h4><span>{{ count(App\Models\Admin\Steps::all()) }}</span> Steps</h4>
          </div>

          <div class="service">
            <div style="background-color: #2b4b60" class="icon"><i style="color: #7d98cf" class="fas fa-fw fa-border-all"></i></div>
            <h4><span>{{ $tables_nums }}</span> Tables</h4>
          </div>

        </div>

      </div>

      <div class="brief">

        <h2 style="display: flex; justify-content: space-between; align-items: center">
          <span><i class="fas fa-fw fa-hashtag mr-8"></i> Activity</span>
          <a href="" class="button ui primary"><i class="fas fa-fw fa-chart-line mr-2"></i> SEE MY ACTIVITY</a>
        </h2>

        <div class="activities">
          @foreach ($activities as $a)
            <div class="activity">
              <div class="icon"><i class="fas fa-fw fa-{{ $a->ac_icon }}"></i></div>
              <div class="information">
                <h2>{{ $a->ac_title }}</h2>
                <p>{{ $a->ac_desc }}</p>
                <span><i class="fas fa-fw fa-clock mr-3"></i> {{ date('d/m/Y - h:i A', strtotime($a->created_at)) }}</span>
              </div>
            </div>
          @endforeach
        </div>

      </div>

    </div>

    <hr>

  </div>
@endsection
