@extends('layouts.user')
@section('title', 'Result ' . $result->search_keyword)
@section('content')

  <div class="search-page">
    <h1 class="title-search"><i class="fas fa-fw fa-search"></i> Result For: "{{ $result->search_keyword }}"</h1>

    <div class="result-menu">
      <div class="ui menu top inverted">
        <a class="active item" data-tab="articles">Articles</a>
        <a class="item" data-tab="courses">Courses</a>
        <a class="item" data-tab="steps">Steps Articles</a>
      </div>
    </div>

    <div class="tabs-content">

      <div class="ui tab active" data-tab="articles">
        <div class="section-result articles-results">
          @forelse($result->articles as $article)
            @php
            $user = \App\Models\User::get_user_by_id($article->article_user);
            @endphp
            <div class="article-res section-output">
              <div class="img">
                <img src="{{ asset($user->picture) }}" alt="">
                <div class="user-description">
                  <div class="user-top">
                    <img src="{{ asset($user->picture) }}" alt="">
                    <div class="text-user">
                      <h3>{{ $user->firstname }}</h3>
                      <span>{{ '@' . $user->username }}</span>
                    </div>
                  </div>
                  <div class="user-info">
                    <ul>
                      <li><span><i class="fas fa-fw fa-clock"></i> Joined in</span> <span>{{ time_formatter($user->created_at, 'd, M Y') }}</span></li>
                      <li><span><i class="fas fa-fw fa-hashtag"></i> ID</span> <span>{{ $user->id }}</span></li>
                      <li><span><i class="fas fa-fw fa-paper-plane"></i> Phone</span> <span>+20{{ $user->phone }}</span></li>
                      <li><span><i class="fas fa-fw fa-user"></i> Job</span> <span>{{ $user->job_title }}</span></li>
                      <li><span><i class="fas fa-fw fa-link"></i> Website</span> <span><a href="{{ $user->website }}" target="_blank"></a>Portfolio</span></li>
                    </ul>
                    <div class="skills">
                    @foreach(explode(',', $user->skills) as $skill)
                        <div class="label ui blue small">{{ $skill }}</div>
                      @endforeach
                    </div>
                    <div class="bio">{{ $user->bio }}</div>
                  </div>
                </div>
              </div>
              <div class="text">
                <h2><a href="{{ route('app.articles.view', $article->article_id) }}">{{ $article->article_title }}</a></h2>
                <span class="time"><i class="fas fa-fw fa-clock"></i> {{ time_formatter($article->created_at) }}</span>
              </div>
            </div>
          @empty
            <div class="empty-result">
              <img src="{{ asset('icons/empty.png') }}" alt="">
              <h1>No Search Result!</h1>
              <p>No Matching results for searched keywords <strong>"{{ $result->search_keyword }}"</strong></p>
            </div>
          @endforelse
        </div>
      </div>

      <div class="ui tab" data-tab="courses">
        <div class="section-result courses-results">
          @forelse($result->courses as $course)
            @php
              $user = \App\Models\User::get_user_by_id($course->course_user);
            @endphp
            <div class="article-res section-output">
              <div class="img">
                <img src="{{ asset($user->picture) }}" alt="">
                <div class="user-description">
                  <div class="user-top">
                    <img src="{{ asset($user->picture) }}" alt="">
                    <div class="text-user">
                      <h3>{{ $user->firstname }}</h3>
                      <span>{{ '@' . $user->username }}</span>
                    </div>
                  </div>
                  <div class="user-info">
                    <ul>
                      <li><span><i class="fas fa-fw fa-clock"></i> Joined in</span> <span>{{ time_formatter($user->created_at, 'd, M Y') }}</span></li>
                      <li><span><i class="fas fa-fw fa-hashtag"></i> ID</span> <span>{{ $user->id }}</span></li>
                      <li><span><i class="fas fa-fw fa-paper-plane"></i> Phone</span> <span>+20{{ $user->phone }}</span></li>
                      <li><span><i class="fas fa-fw fa-user"></i> Job</span> <span>{{ $user->job_title }}</span></li>
                      <li><span><i class="fas fa-fw fa-link"></i> Website</span> <span><a href="{{ $user->website }}" target="_blank"></a>Portfolio</span></li>
                    </ul>
                    <div class="skills">
                      @foreach(explode(',', $user->skills) as $skill)
                        <div class="label ui blue small">{{ $skill }}</div>
                      @endforeach
                    </div>
                    <div class="bio">{{ $user->bio }}</div>
                  </div>
                </div>
              </div>
              <div class="text">
                <h2><a href="{{ route('app.courses.view', $course->course_id) }}">{{ $course->course_title }}</a></h2>
                <span class="time"><i class="fas fa-fw fa-clock"></i> {{ time_formatter($course->created_at) }}</span>
              </div>
            </div>
          @empty
            <div class="empty-result">
              <img src="{{ asset('icons/empty.png') }}" alt="">
              <h1>No Search Result!</h1>
              <p>No Matching results for searched keywords <strong>"{{ $result->search_keyword }}"</strong></p>
            </div>
          @endforelse
        </div>
      </div>

      <div class="ui tab" data-tab="steps">
        <div class="section-result courses-results">
          @forelse($result->howto as $h)
            @php
              $user = \App\Models\User::get_user_by_id($h->h_user);
            @endphp
            <div class="article-res section-output">
              <div class="img">
                <img src="{{ asset($user->picture) }}" alt="">
                <div class="user-description">
                  <div class="user-top">
                    <img src="{{ asset($user->picture) }}" alt="">
                    <div class="text-user">
                      <h3>{{ $user->firstname }}</h3>
                      <span>{{ '@' . $user->username }}</span>
                    </div>
                  </div>
                  <div class="user-info">
                    <ul>
                      <li><span><i class="fas fa-fw fa-clock"></i> Joined in</span> <span>{{ time_formatter($user->created_at, 'd, M Y') }}</span></li>
                      <li><span><i class="fas fa-fw fa-hashtag"></i> ID</span> <span>{{ $user->id }}</span></li>
                      <li><span><i class="fas fa-fw fa-paper-plane"></i> Phone</span> <span>+20{{ $user->phone }}</span></li>
                      <li><span><i class="fas fa-fw fa-user"></i> Job</span> <span>{{ $user->job_title }}</span></li>
                      <li><span><i class="fas fa-fw fa-link"></i> Website</span> <span><a href="{{ $user->website }}" target="_blank"></a>Portfolio</span></li>
                    </ul>
                    <div class="skills">
                      @foreach(explode(',', $user->skills) as $skill)
                        <div class="label ui blue small">{{ $skill }}</div>
                      @endforeach
                    </div>
                    <div class="bio">{{ $user->bio }}</div>
                  </div>
                </div>
              </div>
              <div class="text">
                <h2><a href="{{ route('app.howto.view', $h->h_id) }}">{{ $h->h_title }}</a></h2>
                <span class="time"><i class="fas fa-fw fa-clock"></i> {{ time_formatter($h->created_at) }}</span>
              </div>
            </div>
          @empty
            <div class="empty-result">
              <img src="{{ asset('icons/empty.png') }}" alt="">
              <h1>No Search Result!</h1>
              <p>No Matching results for searched keywords <strong>"{{ $result->search_keyword }}"</strong></p>
            </div>
          @endforelse
        </div>
      </div>

    </div>

  </div>

@endsection

