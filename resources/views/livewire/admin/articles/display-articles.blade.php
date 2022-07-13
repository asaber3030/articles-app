<div class="display-articles control-section">
  <div class="controller">
    <div class="search-bar">
      <div class="field form ui">
        <form method="get">
          @csrf
          <input placeholder="Search for ?" wire:model="search" name="search">
        </form>
      </div>
    </div>
    <div class="actions">
      <div class="ui compact menu">
        <a class="item primary-action" href="{{ route('admin.articles.add') }}"><i class="fas fa-fw fa-plus"></i> Add</a>
        <a class="item primary-action" href="{{ route('admin.articles.stats') }}"><i class="fas fa-fw fa-chart-line"></i> Stats</a>
        <a class="item primary-action" href="{{ route('admin.articles.restore.all') }}"><i class="fas fa-fw fa-trash-restore"></i> Restore <div class="ui yellow label">{{ count(\App\Models\Admin\Articles::all()) }}</div></a>
        <a class="item primary-action" href="{{ route('admin.articles.delete.all') }}"><i class="fas fa-fw fa-trash"></i> Delete <div class="ui red label">{{ count(\App\Models\Admin\Articles::all()) }}</div></a>
      </div>
    </div>
  </div>

  @if (session()->has('msg'))
    <div class="alert success">{{ session()->get('msg') }}</div>
  @endif

  @if(count($articles) > 0)
    <div class="table-container">
      <table class="ui celled inverted table">
        <thead>
        <tr class="head">
          <th>ID</th>
          <th>Article Title</th>
          <th>Tags</th>
          <th>Keywords</th>
          <th>Admin</th>
          <th>User</th>
          <th>Views</th>
          <th>Published in</th>
          <th>Last Update</th>
          <th>Is Deleted?</th>
          <th style="text-align: center; width: 400px">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($articles as $article)
          <tr>
            <td>{{ $article->article_id }}</td>
            <td><span class="truncate">{{ $article->article_title }}</span></td>
            <td>
              @foreach(array_slice(explode(',', $article->article_tags), 0, 3) as $tag)
                <span class="label">{{ $tag }}</span>
              @endforeach
            </td>
            <td>
              @foreach(array_slice(explode(',', $article->article_keywords), 0, 3) as $key)
                <span class="label">{{ $key }}</span>
              @endforeach
            </td>
            <td>{!! $article->admin_username === 'no-one' ? '----' : '<a href=""><i class="fas fa-fw fa-user-lock mr-3"></i> ' . $article->admin_username . '</a>' !!}</td>
            <td>{!! $article->username === 'no-one' ? '----' : '<a href=""><i class="fas fa-fw fa-user mr-3"></i> ' . $article->username . '</a>' !!}</td>
            <td>{{ $article->views }} views</td>
            <td>{{ date('d, M Y', strtotime($article->created_at)) }}</td>
            <td>{{ date('d, M Y', strtotime($article->updated_at)) }}</td>
            <td>{!! $article->status === 0 ? '<span class="red-c">Yes</span>' : '<span class="green-c">No</span>' !!}</td>
            <td class="actions-td">
              <a href="{{ route('admin.articles.update', $article->article_id) }}" class="blue-c blue-border"><i class="fas fa-fw fa-wrench"></i> Update</a>
              <a href="{{ route('admin.articles.view', $article->article_id) }}" style="border-right: 1px solid #fff !important;"><i class="fas fa-fw fa-eye"></i> View</a>
              @if ($article->status === 1)
                <a href="{{ route('admin.articles.delete', $article->article_id) }}"  class="red-c red-border"><i class="fas fa-fw fa-trash"></i> Delete</a>
              @else
                <a href="{{ route('admin.articles.restore', $article->article_id) }}" style="border-right: 1px solid #fff !important;"><i class="fas fa-fw fa-trash-restore"></i> Restore</a>
              @endif
            </td>
          </tr>
        @endforeach

        </tbody>

      </table>
      @php
        $articles = $articles->toArray();
      @endphp
      <div class="ui pagination default-pagination menu float-right">
        @if (!is_null($articles['prev_page_url']))
          <a class="item" href="{{ $articles['prev_page_url'] }}&search={{ $search }}"><i class="fas fa-fw fa-angle-double-left"></i></a>
        @endif
        @php
          array_pop($articles['links']);
          array_shift($articles['links']);
        @endphp
        @foreach ($articles['links'] as $l)
          <a class="item @if ($l['active']) active @endif" href="{{ $l['url'] }}&search={{ $search }}">{{ $l['label'] }}</a>
        @endforeach
        @if (!is_null($articles['next_page_url']))
          <a class="item" href="{{ $articles['next_page_url'] }}&search={{ $search }}"><i class="fas fa-fw fa-angle-double-right"></i></a>
        @endif
      </div>
    </div>
  @else
    <div class="alert primary" style="margin: 20px 0">No Such data with this search keywords <strong>"{{ $search }}"</strong>.</div>
  @endif
</div>
