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
        <a class="item primary-action" href="{{ route('admin.courses.add') }}"><i class="fas fa-fw fa-plus"></i> Add</a>
        <a class="item primary-action" href="{{ route('admin.courses.stats') }}"><i class="fas fa-fw fa-chart-line"></i> Stats</a>
        <a class="item primary-action" href="{{ route('admin.courses.restore.all') }}"><i class="fas fa-fw fa-trash-restore"></i> Restore <div class="ui yellow label">{{ count(\App\Models\Admin\Articles::all()) }}</div></a>
        <a class="item primary-action" href="{{ route('admin.courses.delete.all') }}"><i class="fas fa-fw fa-trash"></i> Delete <div class="ui red label">{{ count(\App\Models\Admin\Articles::all()) }}</div></a>
      </div>
    </div>
  </div>

  @if (session()->has('msg'))
    <div class="alert success">{{ session()->get('msg') }}</div>
  @endif

  @if(count($courses) > 0)
    <div class="table-container">

      <table class="ui celled inverted table">
        <thead>
        <tr class="head">
          <th class="append-order" wire:click="change_order('id')"><i class="fa-solid fa-arrow-down-1-9"></i> ID</th>
          <th class="append-order" wire:click="change_order('name')"><i class="fa-solid fa-arrow-down-1-9"></i> Course Name</th>
          <th class="append-order">Category</th>
          <th class="append-order">Created By</th>
          <th>Total Enrollments</th>
          <th>Status</th>
          <th>Published In</th>
          <th>Last Update</th>
          <th style="text-align: center; max-width: 350px">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($courses as $c)
          <tr>
            <td>{{ $c->course_id }}</td>
            <td>{{ $c->course_title }}</td>
            <td>{{ $c->category_name }}</td>
            <td>{!! $c->username == 'developer' ? "<a href=''>" . '@' . $c->admin_username . "</a>" : "<a href=''>" . '@' . $c->username . "</a>" !!} - {!! $c->username == 'developer' ? "<i class='fas fa-fw fa-user-lock'></i>" : "<i class='fas fa-fw fa-user'></i>" !!}</td>
            <td class="code"><span class="green-c">{{ \App\Models\Admin\Courses::count_enrolls($c->course_id) }}</span> Enrolled</td>
            <td>
              {!! ($c->course_status == 0) ? '<span class=green-c>Not Deleted</span>' : "<span class=red-c>Deleted</span>" !!}
            </td>
            <td>{{ date('d, M Y', strtotime($c->created_at)) }}</td>
            <td>{{ date('d, M Y', strtotime($c->updated_at)) }}</td>
            <td class="actions-td">
              <a href="{{ route('admin.courses.update', $c->course_id) }}" class="blue-c blue-border"><i class="fas fa-fw fa-wrench"></i> Update</a>
              <a href="{{ route('admin.courses.view', $c->course_id) }}" style="border-right: 1px solid #fff !important;"><i class="fas fa-fw fa-eye"></i> View</a>
              @if ($c->course_status === 0)
                <a href="{{ route('admin.courses.delete', $c->course_id) }}"  class="red-c red-border"><i class="fas fa-fw fa-trash"></i> Delete</a>
              @else
                <a href="{{ route('admin.courses.restore', $c->course_id) }}" class="teal-c"><i class="fas fa-fw fa-trash-restore"></i> Restore</a>
              @endif
              <a href="{{ route('admin.courses.add.video', $c->course_id) }}" class="pink-c"><i class="fas fa-fw fa-play"></i> Add Videos</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>

      @php
        $courses = $courses->toArray();
      @endphp
      <div class="ui pagination default-pagination menu float-right">
        @if (!is_null($courses['prev_page_url']))
          <a class="item" href="{{ $courses['prev_page_url'] }}&search={{ $search }}"><i class="fas fa-fw fa-angle-double-left"></i></a>
        @endif
        @php
          array_pop($courses['links']);
          array_shift($courses['links']);
        @endphp
        @foreach ($courses['links'] as $l)
          <a class="item @if ($l['active']) active @endif" href="{{ $l['url'] }}&search={{ $search }}">{{ $l['label'] }}</a>
        @endforeach
        @if (!is_null($courses['next_page_url']))
          <a class="item" href="{{ $courses['next_page_url'] }}&search={{ $search }}"><i class="fas fa-fw fa-angle-double-right"></i></a>
        @endif
      </div>
    </div>
  @else
    <div class="alert primary" style="margin: 20px 0">No Such data with this search keywords <strong>"{{ $search }}"</strong>.</div>
  @endif
</div>

{{--<table class="ui celled inverted table">--}}
{{--  <thead>--}}
{{--  <tr class="head">--}}
{{--    <th>ID</th>--}}
{{--    <th>Course Title</th>--}}
{{--    <th>Category</th>--}}
{{--    <th>Admin</th>--}}
{{--    <th>User</th>--}}
{{--    <th>Published in</th>--}}
{{--    <th>Last Update</th>--}}
{{--    <th>Is Deleted?</th>--}}
{{--    <th style="text-align: center;">Action</th>--}}
{{--  </tr>--}}
{{--  </thead>--}}
{{--  <tbody>--}}
{{--  @foreach ($courses as $course)--}}
{{--    <tr>--}}
{{--      <td>{{ $course->course_id }}</td>--}}
{{--      <td><span class="truncate">{{ $course->course_title }}</span></td>--}}
{{--      <td><label class="ui blue label">{{ $course->category_name }}</label></td>--}}

{{--      @if ($course->username === 'developer')--}}
{{--        <td>{{ $course->admin_username }}</td>--}}
{{--        <td>-----</td>--}}
{{--      @endif--}}
{{--      @if ($course->admin_username === 'developer')--}}
{{--        <td>-----</td>--}}
{{--        <td>{{ $course->username }}</td>--}}
{{--      @endif--}}

{{--      <td>{{ date('d, M Y', strtotime($course->created_at)) }}</td>--}}
{{--      <td>{{ date('d, M Y', strtotime($course->updated_at)) }}</td>--}}
{{--      <td>{!! $course->course_status === 1 ? '<span class="red-c">Yes</span>' : '<span class="green-c">No</span>' !!}</td>--}}
{{--      <td class="actions-td">--}}
{{--        <a href="{{ route('admin.courses.update', $course->course_id) }}" class="blue-c blue-border"><i class="fas fa-fw fa-wrench"></i> Update</a>--}}
{{--        <a href="{{ route('admin.courses.view', $course->course_id) }}" style="border-right: 1px solid #fff !important;"><i class="fas fa-fw fa-eye"></i> View</a>--}}
{{--        @if ($course->course_status === 0)--}}
{{--          <a href="{{ route('admin.courses.delete', $course->course_id) }}"  class="red-c red-border"><i class="fas fa-fw fa-trash"></i> Delete</a>--}}
{{--        @else--}}
{{--          <a href="{{ route('admin.courses.restore', $course->course_id) }}" class="teal-c"><i class="fas fa-fw fa-trash-restore"></i> Restore</a>--}}
{{--        @endif--}}
{{--        <a href="{{ route('admin.courses.add.video', $course->course_id) }}" class="pink-c"><i class="fas fa-fw fa-play"></i> Add Videos</a>--}}
{{--      </td>--}}
{{--    </tr>--}}
{{--  @endforeach--}}

{{--  </tbody>--}}

{{--</table>--}}
