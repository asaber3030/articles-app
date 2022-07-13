
<div class="search-box">
  <div class="form ui">
    <div class="field ui">
      <form wire:submit="submitSearch" wire:submit.prevent action="" method="GET">
        <input class="show-search-in-focus" autocomplete="off" wire:model="search" type="text" placeholder="Search for something..." name="search">
      </form>
    </div>
  </div>

  <div class="output">

    <div wire:loading class="loading"><i class="fas fa-fw fa-spinner"></i> Searching for articles......</div>

    <div wire:loading.remove>
      @if ($search === '')
        <div class="no-search"><i class="fas fa-fw fa-exclamation-circle"></i> Empty......</div>
      @else
        @if ($articles->isEmpty() && $courses->isEmpty() && $howto->isEmpty())
          <div class="empty-search">Nothing with this keywords</div>
        @else

          <h2 class="title"><i class="fas fa-fw fa-hashtag"></i> Articles</h2>
          @forelse($articles as $article)
            <div class="result"><a href="{{ route('app.articles.view', $article->article_id) }}"><i class="fas fa-fw fa-chart-line"></i> {{ $article->article_title }}</a></div>
          @empty
            <div class="empty-search">No Articles</div>
          @endforelse

          <h2><i class="fas fa-fw fa-hashtag"></i> Courses</h2>
          @forelse($courses as $course)
            <div class="result"><a href="{{ route('app.courses.view', $article->article_id) }}"><i class="fas fa-fw fa-chart-line"></i> {{ $course->course_title }}</a></div>
          @empty
            <div class="empty-search">No Courses</div>
          @endforelse

          <h2><i class="fas fa-fw fa-hashtag"></i> How to Articles</h2>
          @forelse($howto as $h)
            <div class="result"><a href=""><i class="fas fa-fw fa-chart-line"></i> {{ $h->h_title }}</a></div>
          @empty
            <div class="empty-search">No Step Articles</div>
          @endforelse

          <div class="see-all" style="margin-top: 15px; "><button class="ui button primary small" goto=""><i class="fas fa-fw fa-chart-line"></i> See All</button></div>
        @endif
      @endif

    </div>

  </div>

</div>
