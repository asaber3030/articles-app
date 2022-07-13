<div class="courses-landing-page">
  <div class="title">
    <h1><i class="fas fa-fw fa-play"></i> Courses</h1>
    <div class="form ui">
      <input type="text" wire:model="search" placeholder="Search for Courses">
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

      <div class="filter field">
        <label for="">Category</label>
        <select name="" id="" wire:model="category_filter">
          <option value="">All</option>
          @foreach (\App\Models\Categories::all() as $c)
            <option value="{{ $c->category_id }}">{{ $c->category_name }}</option>
          @endforeach
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

    <div class="courses">

      @forelse ($courses as $course)
        @php
          $category = \App\Models\Categories::find($course->course_category);
          $user = \App\Models\User::get_user_by_id($course->course_user)
        @endphp
        <div class="course">
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
                @if (!\App\Models\Enrollments::i_have_enrolled_in($course->course_id, id()))
                  <button class="ui button blue small" wire:click="enroll_in_course('{{ $course->course_id }}')"><i class="fas fa-fw fa-check"></i> Enroll</button>
                @else
                  <button class="ui button blue small" wire:click="unenroll_in_course('{{ $course->course_id }}')"><i class="fas fa-fw fa-times"></i> UnEnroll</button>
                @endif
                @if (!\App\Models\FavCourses::is_added_before($course->course_id, id()))
                  <button class="ui button small red" wire:click="add_to_favs('{{ $course->course_id }}')"><i class="fas fa-fw fa-save"></i> Save</button>
                @else
                  <button class="ui button small red" wire:click="remove_from_favs('{{ $course->course_id }}')"><i class="fas fa-fw fa-trash"></i> Unsave</button>
                @endif
              @endauth
              <a class="ui button small" href="{{ route('app.courses.view', $course->course_id) }}"><i class="fas fa-fw fa-eye"></i> View</a>
            </div>
          </div>
        </div>
      @empty
        <div class="no-courses"><i class="fas fa-fw fa-exclamation-triangle"></i> Empty Data</div>
      @endforelse

    </div>

    @if ($courses->lastPage() > 1)
      <div class="ui pagination inverted menu" style="margin-top: 20px">
        @for ($i = 1; $i <= $courses->lastPage(); $i++)
          <a href="{{ $courses->url($i) }}" class="{{ ($courses->currentPage() == $i) ? ' active' : '' }} item">
            {{ $i }}
          </a>
        @endfor
      </div>
    @endif
  </div>

</div>
