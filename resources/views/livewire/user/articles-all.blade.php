<div class="my-articles second-section">

  <div class="title">
    <h1><i class="fas fa-fw fa-hashtag"></i> My Published Articles</h1>
    <div class="ui form">
      <div class="field">
        <input type="text" placeholder="Search for" wire:model="message">
      </div>
    </div>
  </div>


  <div class="table-container">
    <table class="ui selectable inverted celled table">
      <thead>
      <tr>
        <th class="clickable" wire:click="inverseTable"><i class="fas fa-fw fa-chevron-up"></i> ID</th>
        <th>Title</th>
        <th>Tags</th>
        <th>Keywords</th>
        <th>Views</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>

      @foreach($articles as $article)
        <tr>
          <td>{{ $article->article_id }}</td>
          <td class="elli">{{ $article->article_title }}</td>
          <td class="elli">{{ $article->article_tags }}</td>
          <td class="elli">{{ $article->article_keywords }}</td>
          @php
          $views =\App\Models\ArticleViews::count_views_of_article($article->article_id);

          @endphp
          <td><div class="ui  horizontal"><a href="{{ $views === 0 ? '#' : route('profile.articles.views', $article->article_id) }}">{{ $views }} views</a></div></td>
          <td>
            @if ($article->status === 0)
              <div class="private-label lbl"><i class="fas fa-fw fa-lock"></i> Private</div>
            @else
              <div class="public-label lbl"><i class="fas fa-fw fa-check"></i> Public</div>
            @endif
          </td>
          <td>
            <a href="{{ route('profile.articles.delete', $article->article_id) }}" class="btn btn-success"><i class="fas fa-fw fa-trash"></i></a>
            <a href="{{ route('profile.articles.update', $article->article_id) }}" class="btn btn-success"><i class="fas fa-fw fa-wrench"></i></a>
            <a href="{{ route('app.articles.view', $article->article_id) }}" class="btn btn-success"><i class="fas fa-fw fa-eye"></i></a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>

    @if ($articles->lastPage() > 1)
      <div class="ui pagination inverted menu">
        @for ($i = 1; $i <= $articles->lastPage(); $i++)
          <a href="{{ $articles->url($i) }}" class="{{ ($articles->currentPage() == $i) ? ' active' : '' }} item">
            {{ $i }}
          </a>
        @endfor
      </div>
    @endif

  </div>
</div>
