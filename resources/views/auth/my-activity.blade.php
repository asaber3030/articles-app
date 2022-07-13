@extends('layouts.user')
@section('title', 'My Activities')
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <div class="my-activity-section view-course-data second-section">

      <h1 class="heading"><i class="fas fa-fw fa-chart-line"></i> My Activity</h1>

      <div class="activities">

        @forelse($activities as $ac)

        <div class="activity" goto="{{ $ac->ac_link }}">

          <div class="icon">
            <i class="fas fa-fw fa-{{ $ac->ac_icon }} fa-4x"></i>
          </div>

          <div class="text">
            <h1 class="heading-ac">{{ $ac->ac_title }}</h1>
            <p class="desc">{{ $ac->ac_desc }}</p>
            <div class="time"><i class="fas fa-fw fa-clock"></i> {{ time_formatter($ac->created_at) }}</div>
          </div>

        </div>

        @empty

          <div class="empty">No Activities</div>

        @endforelse

        @if($activities)
          @php
            $activities = $activities->toArray();
            array_pop($activities['links']);
            array_shift($activities['links']);
          @endphp

          @if (count($activities['links']) > 1)
            <div class="ui pagination default-pagination menu inverted">
              @if (!is_null($activities['prev_page_url']))
                <a class="item" href="{{ $activities['prev_page_url'] }}"><i class="fas fa-fw fa-angle-left"></i></a>
              @endif
              @foreach ($activities['links'] as $l)
                <a class="item @if ($l['active']) active @endif" href="{{ $l['url'] }}">{{ $l['label'] }}</a>
              @endforeach
              @if (!is_null($activities['next_page_url']))
                <a class="item" href="{{ $activities['next_page_url'] }}"><i class="fas fa-fw fa-angle-right"></i></a>
              @endif
            </div>
          @endif
        @endif

      </div>

    </div>

  </div>

@endsection
