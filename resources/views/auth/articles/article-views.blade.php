@extends('layouts.user')
@section('title', 'Articles')
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <div class="enrolled-users second-section">

      <h1>Who Viewed My Article: <span>{{ $article->article_title }}</span></h1>

      <div class="users">
        @forelse($views as $v)
          <div class="user">
            <h4><a href=""><i class="fas fa-fw fa-user"></i> {{ '@' . \App\Models\User::get_user_by_id($v->view_user)->username }}</a></h4>
            <span><i class="fas fa-fw fa-clock"></i> {{ time_formatter($v->created_at, 'd, M Y') }}</span>
          </div>
        @empty
          <div class="no-enrolls">No Views</div>
        @endforelse
      </div>

    </div>

  </div>


@endsection
