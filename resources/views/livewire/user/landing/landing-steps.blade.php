<div class="articles-landing-page">
  <div class="title">
    <h1><i class="fas fa-fw fa-question"></i> Step Articles</h1>
    <div class="form ui">
      <input type="text" wire:model="search" placeholder="Search for Articles">
    </div>
  </div>

  <div class="filters">

    <div class="d-flex ui form">

      <div class="filter field">
        <label for="">Order Alphabetically</label>
        <select wire:model="letter_filter">
          <option value="az">From A-Z</option>
          <option value="za">From Z-A</option>
        </select>
      </div>


      <div class="filter field">
        <label>Time</label>
        <select name="" id="" wire:model="time_filter">
          <option value="old">Oldest</option>
          <option value="new">Newest</option>
        </select>
      </div>

    </div>

  </div>

  <div wire:loading>
    <div class="loading-div">
      <div class="ui active dimmer">
        <div class="ui text loader">Loading</div>
      </div>
      <p>Loading data.....</p>
    </div>
  </div>

  <div wire:loading.remove>

    <div class="articles">
      @forelse($articles as $article)
        @php
          $user = \App\Models\User::find($article->h_user);
        @endphp
        <div class="article">

          @auth
            @if (!\App\Models\FavSteps::is_added_before($article->h_id, id()))
              <div class="bookmarks-ar" wire:click="add_to_favs('{{ $article->h_id }}')">
                <i class="far fa-fw fa-bookmark fa-2x add-to-book"></i>
              </div>
            @else
              <div class="bookmarks-ar" wire:click="remove_from_favs('{{ $article->h_id }}')">
                <i class="fas fa-fw fa-bookmark fa-2x remove-from-book" wire:click="remove_from_favs('{{ $article->h_id }}')"></i>
              </div>
            @endif
          @endauth

          <div class="user-left-image">
            <img src="{{ asset($user->picture) }}" alt="User image">
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
          <div class="article-desc">
            <h3><a href="{{ route('app.howto.view', $article->h_id) }}">{{ $article->h_title }}</a></h3>
            <div class="tags">
              @foreach(explode(',', $article->h_tags) as $t)
                <div class="lbl">{{ $t }}</div>
              @endforeach
            </div>
          </div>
        </div>
      @empty
        <div class="empty-data"><i class="fas fa-fw fa-exclamation-triangle"></i> Empty Data</div>
      @endforelse
    </div>

    @if ($articles->lastPage() > 1)
      <div class="ui pagination inverted menu" style="margin-top: 20px">
        @for ($i = 1; $i <= $articles->lastPage(); $i++)
          <a href="{{ $articles->url($i) }}" class="{{ ($articles->currentPage() == $i) ? ' active' : '' }} item">
            {{ $i }}
          </a>
        @endfor
      </div>
    @endif
  </div>

</div>
