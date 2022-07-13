@extends('layouts.user')
@section('title', APP_NAME . ' - Home')
@section('content')

  <div class="landing-home">
    <div class="top-items">
      <div class="content">
        <h1>Let's get all ready! everything is easy with <code>{{ APP_NAME . ';' }}</code></h1>
        <p>Explore everything and get new knowledge of what you want!</p>
        <div class="search">
          <livewire:user.search-box />
        </div>
      </div>
    </div>
    <div class="bottom-items">
      <div class="boxes">
        <div class="box">
          <img src="{{ asset('icons/article.png') }}" alt="Articles">
          <h2>Articles</h2>
          <p>Very Important articles is here and you can publish yours!</p>
          <a href="{{ route('app.articles') }}" class="ui button"><i class="fas fa-fw fa-globe"></i> Explore</a>
        </div>

        <div class="box">
          <img src="{{ asset('icons/enroll.png') }}" alt="Steps">
          <h2>Step Articles</h2>
          <p>You can publish your article in form of steps for doing some job!</p>
          <a href="{{ route('app.howto') }}" class="ui button"><i class="fas fa-fw fa-globe"></i> Explore</a>
        </div>

        <div class="box">
          <img src="{{ asset('icons/online-course.png') }}" alt="Steps">
          <h2>Courses</h2>
          <p>We've also courses completely free you can enroll and watch it later</p>
          <a href="{{ route('app.courses') }}" class="ui button"><i class="fas fa-fw fa-globe"></i> Explore</a>
        </div>

      </div>
    </div>
  </div>

@endsection
