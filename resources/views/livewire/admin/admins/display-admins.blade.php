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
        <a class="item primary-action" href="{{ route('admin.admins.add') }}"><i class="fas fa-fw fa-plus"></i> Add</a>
      </div>
    </div>
  </div>

  @php
    use App\Models\Admin\Admin;
  @endphp

  @if (session()->has('msg'))
    <div class="alert success">{{ session()->get('msg') }}</div>
  @endif

  @if(count($admins) > 0)

    <div class="table-container">

      <table class="ui celled inverted table">
        <thead>
        <tr class="head">
          <th class="append-order" wire:click="change_order('id')"><i class="fa-solid fa-arrow-down-1-9"></i> ID</th>
          <th class="append-order" wire:click="change_order('name')"><i class="fa-solid fa-arrow-down-1-9"></i> Username</th>
          <th>Picture</th>
          <th>No. Of Articles</th>
          <th>No. Of Courses</th>
          <th>No. Of Steps Articles</th>
          <th>Published In</th>
          <th>Last Update</th>
          <th style="text-align: center; ">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($admins as $admin)
          <tr>
            <td>{{ $admin->admin_id }}</td>
            <td><span class="truncate">{{ $admin->admin_username }}</span></td>
            <td><img style="width: 32px; margin: 0 auto;" src="{{ asset($admin->admin_picture) }}" class="inverse-img" alt="User picture"></td>
            <td><span class="code green-c">{{ Admin::count_admin_articles($admin->admin_id) }} Article(s)</span></td>
            <td><span class="code green-c">{{ Admin::count_admin_courses($admin->admin_id) }} Course(s)</span></td>
            <td><span class="code green-c">{{ Admin::count_admin_howto($admin->admin_id) }} Step(s)</span></td>
            <td>{{ date('d, M Y', strtotime($admin->created_at)) }}</td>
            <td>{{ date('d, M Y', strtotime($admin->updated_at)) }}</td>
            <td>
              <a href="{{ route('admin.admins.update', $admin->admin_id) }}" class="ui button black small"><i class="fas fa-fw fa-wrench"></i></a>
              @if ($admin->admin_role === 1)
                <a href="{{ route('admin.admins.delete', $admin->admin_id) }}" class="ui button red small"><i class="fas fa-fw fa-trash"></i></a>
              @endif
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>

      @php
        $admins = $admins->toArray();
      @endphp
      <div class="ui pagination default-pagination menu float-right">
        @if (!is_null($admins['prev_page_url']))
          <a class="item" href="{{ $admins['prev_page_url'] }}&search={{ $search }}"><i class="fas fa-fw fa-angle-double-left"></i></a>
        @endif
        @php
          array_pop($admins['links']);
          array_shift($admins['links']);
        @endphp
        @foreach ($admins['links'] as $l)
          <a class="item @if ($l['active']) active @endif" href="{{ $l['url'] }}&search={{ $search }}">{{ $l['label'] }}</a>
        @endforeach
        @if (!is_null($admins['next_page_url']))
          <a class="item" href="{{ $admins['next_page_url'] }}&search={{ $search }}"><i class="fas fa-fw fa-angle-double-right"></i></a>
        @endif
      </div>

    </div>
  @else

    <div class="alert primary alert-disable-hide" style="margin: 20px 0">No Such data with this search keywords <strong>"{{ $search }}"</strong>.</div>

  @endif

</div>
