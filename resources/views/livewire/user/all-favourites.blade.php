<div class="user-bookmarks second-section">
  <div class="title">
    <h1><i class='fas fa-fw fa-bookmark'></i> My Bookmarks</h1>
    <div class="empty-all">
      <button class="ui button" wire:click="trash_all"><i class="fas fa-fw fa-trash"></i> Trash All</button>
    </div>
  </div>

  <div class="tabs-menu">
    <div class="ui menu top inverted">
      <a class="active item" data-tab="articles-bookmarks">Articles</a>
      <a class="item" data-tab="courses-bookmarks">Courses</a>
      <a class="item" data-tab="steps-bookmarks">Steps Articles</a>
    </div>
  </div>

  <div class="tabs-content">

    <div class="ui tab active" data-tab="articles-bookmarks">

      <div class="articles-bookmarks bookmarks">
        @forelse($articles as $fv)
          @php
          $article = \App\Models\Articles::find($fv->fa_article);
          $user = \App\Models\User::find($article->article_user);
          @endphp
          <div class="bookmark article-bookmark">
            <div class="bookmark-remove" wire:click="article_remove('{{ $article->article_id }}')">
              <i class="fas fa-fw fa-bookmark"></i>
            </div>
            <div class="left-item">
              <img src="{{ asset($user->picture) }}" alt="">
            </div>
            <div class="right-item">
              <h3><a href="{{ route('app.articles.view', $article->article_id) }}">{{ $article->article_title }}</a></h3>
              <div class="tags">
                @foreach(explode(',', $article->article_tags) as $t)
                  <div class="lbl">{{ $t }}</div>
                @endforeach
              </div>
            </div>
          </div>
        @empty
          <div class="no-bookmarks"><i class="fas fa-fw fa-exclamation-triangle"></i> No Bookmarks. <a href="{{ route('app.articles') }}">Explore</a></div>
        @endforelse
      </div>

    </div>

    <div class="ui tab" data-tab="courses-bookmarks">
      <div class="courses-bookmarks bookmarks">

        @forelse ($courses as $fv)
          @php
            $course = \App\Models\Courses::find($fv->fc_course);
            $category = \App\Models\Categories::find($course->course_category);
            $user = \App\Models\User::get_user_by_id($fv->fc_user)
          @endphp
          <div class="course-bookmark">
            <img src="{{ asset($category->category_icon) }}" alt="">
            <div class="text">
              <h3>{{ $course->course_title }}</h3>
              <ul>
                <li><span><i class="fas fa-fw fa-video"></i> Lectures</span> <span>{{ \App\Models\CourseLectures::count_lectures($course->course_id) }} lecture</span></li>
                <li><span><i class="fas fa-fw fa-list"></i> Category name</span> <span class="ui label blue small">{{ $category->category_name }}</span></li>
                <li><span><i class="fas fa-fw fa-clock"></i> Published At</span> <span>{{ time_formatter($course->created_at, 'd, M Y') }}</span></li>
                <li><span><i class="fas fa-fw fa-check"></i> Total Enrolled Users</span> <span>{{ \App\Models\Enrollments::count_enrolls($course->course_id) }}</span></li>
                <li><span><i class="fas fa-fw fa-user"></i> Author</span> <span>{{ '@' . $user->username }}</span></li>
              </ul>
              <div class="actions">
                @auth
                  @if (\App\Models\Enrollments::i_have_enrolled_in($course->course_id, id()))
                    <button class="ui button blue small" wire:click="unenroll_in_course('{{ $course->course_id }}')"><i class="fas fa-fw fa-times"></i> UnEnroll</button>
                  @endif
                  <button class="ui button red small" wire:click="course_remove('{{ $course->course_id }}')"><i class="fas fa-fw fa-bookmark"></i> Remove</button>
                @endauth
                <a class="ui button small" href="{{ route('app.courses.view', $course->course_id) }}"><i class="fas fa-fw fa-eye"></i> View</a>
              </div>
            </div>
          </div>
        @empty
          <div class="no-bookmarks"><i class="fas fa-fw fa-exclamation-triangle"></i> No Bookmarks. <a href="{{ route('app.courses') }}">Explore</a></div>
        @endforelse
      </div>
    </div>

    <div class="ui tab" data-tab="steps-bookmarks">
      <div class="articles-bookmarks bookmarks">
        @forelse($steps as $fv)
          @php
            $article = \App\Models\Steps::find($fv->fs_step);
            $user = \App\Models\User::find($article->h_user);
          @endphp
          <div class="bookmark article-bookmark">
            <div class="bookmark-remove" wire:click="step_article_remove('{{ $article->h_id }}')">
              <i class="fas fa-fw fa-bookmark"></i>
            </div>
            <div class="left-item">
              <img src="{{ asset($user->picture) }}" alt="">
            </div>
            <div class="right-item">
              <h3><a href="{{ route('app.howto.view', $article->h_id) }}">{{ $article->h_title }}</a></h3>
              <div class="tags">
                @foreach(explode(',', $article->h_tags) as $t)
                  <div class="lbl">{{ $t }}</div>
                @endforeach
              </div>
            </div>
          </div>
        @empty
          <div class="no-bookmarks"><i class="fas fa-fw fa-exclamation-triangle"></i> No Bookmarks. <a href="{{ route('app.howto') }}">Explore</a></div>
        @endforelse
      </div>

    </div>

  </div>

</div>
