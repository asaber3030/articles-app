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
        <a class="item primary-action" href="{{ route('admin.howto.add') }}"><i class="fas fa-fw fa-plus"></i> Add</a>
        <a class="item primary-action" href="{{ route('admin.howto.stats') }}"><i class="fas fa-fw fa-chart-line"></i> Stats</a>
        <a class="item primary-action" href="{{ route('admin.howto.restore.all') }}"><i class="fas fa-fw fa-trash-restore"></i> Restore <div class="ui yellow label">{{ count(\App\Models\Admin\Steps::all()) }}</div></a>
        <a class="item primary-action" href="{{ route('admin.howto.delete.all') }}"><i class="fas fa-fw fa-trash"></i> Delete <div class="ui red label">{{ count(\App\Models\Admin\Steps::all()) }}</div></a>
      </div>
    </div>
  </div>

  @if (session()->has('msg'))
    <div class="alert success">{{ session()->get('msg') }}</div>
  @endif

  @if(count($steps) > 0)
    <div class="table-container">

      <table class="ui celled inverted table">
        <thead>
        <tr class="head">
          <th class="append-order" wire:click="change_order('id')"><i class="fa-solid fa-arrow-down-1-9"></i> ID</th>
          <th class="append-order" wire:click="change_order('name')"><i class="fa-solid fa-arrow-down-1-9"></i> Step title</th>
          <th>Created By</th>
          <th>Keywords</th>
          <th>Tags</th>
          <th>Deleted?</th>
          <th>Published In</th>
          <th>Last Update</th>
          <th style="text-align: center; max-width: 350px">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($steps as $step)
          <tr>
            <td>{{ $step->h_id }}</td>
            <td class="truncate"><span class="truncate">{{ $step->h_title }}</span></td>
            <td>{!! $step->username == 'developer' ? "<a href=''>" . '@' . $step->admin_username . "</a>" : "<a href=''>" . '@' . $step->username . "</a>" !!} - {!! $step->username == 'developer' ? "<i class='fas fa-fw fa-user-lock'></i>" : "<i class='fas fa-fw fa-user'></i>" !!}</td>
            <td>
              @foreach(array_slice(explode(',', $step->h_tags), 0, 3) as $tag)
                <span class="label">{{ $tag }}</span>
              @endforeach
            </td>
            <td>
              @foreach(array_slice(explode(',', $step->h_keywords), 0, 3) as $key)
                <span class="label">{{ $key }}</span>
              @endforeach
            </td>
            <td>{!! ($step->h_status == 0) ? '<span class=green-c>Not Deleted</span>' : "<span class=red-c>Deleted</span>" !!}</td>
            <td>{{ date('d, M Y', strtotime($step->created_at)) }}</td>
            <td>{{ date('d, M Y', strtotime($step->updated_at)) }}</td>
            <td class="actions-td">
              <a href="{{ route('admin.howto.update', $step->h_id) }}" class="blue-c blue-border"><i class="fas fa-fw fa-wrench"></i> Update</a>
              <a href="{{ route('admin.howto.view', $step->h_id) }}" style="border-right: 1px solid #fff !important;"><i class="fas fa-fw fa-eye"></i> View</a>
              @if ($step->h_status === 0)
                <a href="{{ route('admin.howto.delete', $step->h_id) }}"  class="red-c red-border"><i class="fas fa-fw fa-trash"></i> Delete</a>
              @else
                <a href="{{ route('admin.howto.restore', $step->h_id) }}" class="teal-c"><i class="fas fa-fw fa-trash-restore"></i> Restore</a>
              @endif
              <a href="{{ route('admin.howto.step.add', $step->h_id) }}" class="pink-c"><i class="fas fa-fw fa-play"></i> Add Steps</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>

      @php
        $steps = $steps->toArray();
      @endphp
      <div class="ui pagination default-pagination menu float-right">
        @if (!is_null($steps['prev_page_url']))
          <a class="item" href="{{ $steps['prev_page_url'] }}&search={{ $search }}"><i class="fas fa-fw fa-angle-double-left"></i></a>
        @endif
        @php
          array_pop($steps['links']);
          array_shift($steps['links']);
        @endphp
        @foreach ($steps['links'] as $l)
          <a class="item @if ($l['active']) active @endif" href="{{ $l['url'] }}&search={{ $search }}">{{ $l['label'] }}</a>
        @endforeach
        @if (!is_null($steps['next_page_url']))
          <a class="item" href="{{ $steps['next_page_url'] }}&search={{ $search }}"><i class="fas fa-fw fa-angle-double-right"></i></a>
        @endif
      </div>
    </div>
  @else
    <div class="alert primary" style="margin: 20px 0">No Such data with this search keywords <strong>"{{ $search }}"</strong>.</div>
  @endif
</div>
