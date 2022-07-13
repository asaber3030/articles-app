<div class="display-users control-section">
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
        <a class="item primary-action" href="{{ route('admin.users.add') }}"><i class="fas fa-fw fa-plus"></i> Add</a>
        <a class="item primary-action" href="{{ route('admin.users.stats') }}"><i class="fas fa-fw fa-chart-line"></i> Stats</a>
        <a class="item primary-action" href="{{ route('admin.users.restore.all') }}"><i class="fas fa-fw fa-trash-restore"></i> Restore <div class="ui yellow label">{{ \App\Models\Admin\Users::count_deleted() }}</div></a>
        <a class="item primary-action" href="{{ route('admin.users.delete.all') }}"><i class="fas fa-fw fa-trash"></i> Delete <div class="ui red label">{{ \App\Models\Admin\Users::count_available() }}</div></a>
      </div>
    </div>
  </div>

  @php
    use App\Models\Admin\Users;
  @endphp

  @if (session()->has('msg'))
    <div class="alert success">{{ session()->get('msg') }}</div>
  @endif

  @if(count($users) > 0)
    <div class="table-container">
      <table class="ui celled inverted table">
        <thead>
        <tr class="head">
          <th>ID</th>
          <th>Username</th>
          <th>Picture</th>
          <th>Published Articles</th>
          <th>Published Howto</th>
          <th>Published Courses</th>
          <th>Created At</th>
          <th>Updated At</th>
          <th>Status</th>
          <th class="code" style="white-space: nowrap; width: 1%;">
            <span class="code">{ View, Delete OR Restore, Update }</span>
          </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td><span class="truncate">{{ $user->username }}</span></td>
            <td><img style="width: 32px; margin: 0 auto;" src="{{ asset($user->picture) }}" class="inverse-img" alt="User picture"></td>
            <td><span class="code green-c">{{ Users::count_user_articles($user->id) }} Article(s)</span></td>
            <td><span class="code green-c">{{ Users::count_user_courses($user->id) }} Course(s)</span></td>
            <td><span class="code green-c">{{ Users::count_user_howto($user->id) }} Step(s)</span></td>
            <td>{{ date('d, M Y', strtotime($user->created_at)) }}</td>
            <td>{{ date('d, M Y', strtotime($user->updated_at)) }}</td>
            <td>{!! $user->user_status === 1 ? 'Approved' : 'Deleted' !!}</td>
            <td>
              <a href="{{ route('admin.users.view', $user->id) }}" class="ui button purple small"><i class="fas fa-fw fa-eye"></i></a>
              @if ($user->user_status === 1)
                <a href="{{ route('admin.users.delete', $user->id) }}" class="ui button red small"><i class="fas fa-fw fa-trash"></i></a>
              @else
                <a href="{{ route('admin.users.restore', $user->id) }}" class="ui button small"><i class="fas fa-fw fa-trash-restore"></i></a>
              @endif
              <a href="{{ route('admin.users.update', $user->id) }}" class="ui button black small"><i class="fas fa-fw fa-wrench"></i></a>
            </td>

          </tr>
        @endforeach

        </tbody>

      </table>
      @php
        $users = $users->toArray();
      @endphp
      <div class="ui pagination default-pagination menu float-right">
        @if (!is_null($users['prev_page_url']))
          <a class="item" href="{{ $users['prev_page_url'] }}&search={{ $search }}"><i class="fas fa-fw fa-angle-double-left"></i></a>
        @endif
        @php
          array_pop($users['links']);
          array_shift($users['links']);
        @endphp
        @foreach ($users['links'] as $l)
          <a class="item @if ($l['active']) active @endif" href="{{ $l['url'] }}&search={{ $search }}">{{ $l['label'] }}</a>
        @endforeach
        @if (!is_null($users['next_page_url']))
          <a class="item" href="{{ $users['next_page_url'] }}&search={{ $search }}"><i class="fas fa-fw fa-angle-double-right"></i></a>
        @endif
      </div>
    </div>
  @else
    <div class="alert primary" style="margin: 20px 0">No Such data with this search keywords <strong>"{{ $search }}"</strong>.</div>
  @endif
</div>
