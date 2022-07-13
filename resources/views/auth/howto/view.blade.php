@extends('layouts.user')
@section('title', 'Howto Article | ' . $howto->h_title)
@section('content')

<div class="profile-page">

  @include('auth.sidebar')

  <div class="view-section view-howto-data second-section">

    <h1 class="heading"><i class="fas fa-fw fa-question-circle"></i> {{ $howto->h_title }}</h1>

    <div class="steps">

      @foreach ($steps as $key => $s)

      <div class="step">

        <div class="header">
          <h1><i class="fas fa-fw fa-hashtag"></i> {{ $key + 1 }}. {{ $s->step_title }}</h1>
          <div class="actions">
            <a href="{{ route('profile.howto.delete.step', [$s->belongs_to, $s->step_id]) }}" class="button ui red"><i class="fas fa-fw fa-trash"></i></a>
            <a href="{{ route('profile.howto.update.step', [$s->belongs_to, $s->step_id]) }}" class="button ui primary"><i class="fas fa-fw fa-wrench"></i></a>
          </div>
        </div>

        <div class="content">
          {!! $s->step_content !!}
        </div>

      </div>

      @endforeach

    </div>

  </div>

</div>

@endsection
