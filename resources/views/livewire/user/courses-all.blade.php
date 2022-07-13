<div class="my-articles second-section">

  <div class="title">
    <h1><i class="fas fa-fw fa-hashtag"></i> Uploaded Courses</h1>
    <div class="ui form">
      <div style="display: flex;">

        <div class="field">
          <a href="{{ route('profile.courses.add') }}" class="ui button primary">Add</a>
        </div>
        <div class="field">
          <input type="text" placeholder="Search for" wire:model="search">
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex">
    <div class="table-container">
      <table class="ui selectable inverted celled table">
        <thead>
        <tr>
          <th class="clickable" wire:click="inverseTable"><i class="fas fa-fw fa-chevron-up"></i> ID</th>
          <th>Title</th>
          <th>Published in</th>
          <th>Last Update</th>
          <th>Category</th>
          <th>Status</th>
          <th>Lectures</th>
          <th>Enrolls</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($courses as $course)
          <tr>
            <td>{{ $course->course_id }}</td>
            <td class="elli">{{ $course->course_title }}</td>
            <td class="elli">{{ time_formatter($course->created_at, 'd, M Y') }}</td>
            <td class="elli">{{ time_formatter($course->updated_at, 'd, M Y') }}</td>
            <td><div class="ui green horizontal label">{{ \App\Models\Categories::category_name($course->course_category) }}</div></td>
            <td>
              @if ($course->is_private === 1)
                <div class="private-label lbl"><i class="fas fa-fw fa-lock"></i> Private</div>
              @else
                <div class="public-label lbl"><i class="fas fa-fw fa-check"></i> Public</div>
              @endif
            </td>
            <td><a href="">{{ App\Models\CourseLectures::count_lectures($course->course_id) }} lectures</a></td>
            <td><a href="{{ route('profile.courses.enrolled', $course->course_id) }}">{{ App\Models\Enrollments::count_enrolls($course->course_id) }} enrolled</a></td>
            <td>
              <a href="{{ route('profile.courses.delete', $course->course_id) }}" class="btn btn-success"><i class="fas fa-fw fa-trash"></i></a>
              <a href="{{ route('profile.courses.update', $course->course_id) }}" class="btn btn-success"><i class="fas fa-fw fa-wrench"></i></a>
              <a href="{{ route('profile.courses.add.lecture', $course->course_id) }}" class="btn btn-success"><i class="fas fa-fw fa-plus"></i></a>
              <a href="{{ route('profile.courses.view', $course->course_id) }}" class="btn btn-success"><i class="fas fa-fw fa-eye"></i></a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>

      @if ($courses->lastPage() > 1)
        <div class="ui pagination inverted menu">
          @for ($i = 1; $i <= $courses->lastPage(); $i++)
            <a href="{{ $courses->url($i) }}" class="{{ ($courses->currentPage() == $i) ? ' active' : '' }} item">
              {{ $i }}
            </a>
          @endfor
        </div>
      @endif

    </div>
  </div>

</div>
