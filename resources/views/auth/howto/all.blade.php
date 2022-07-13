@extends('layouts.user')
@section('title', 'My How to Articles')
@section('content')

<div class="profile-page">

  @include('auth.sidebar')

  <div class="my-howto-articles second-section">

    <h1><i class="fas fa-fw fa-question"></i> My Published How to Articles</h1>

    @foreach ($steps as $step)

      <div class="article">

        <h1><a href="{{ route('profile.howto.view', $step->h_id) }}"><i class="fal fa-fw fa-hashtag"></i> {{ $step->h_title }}</a></h1>
        <span class="time"><i class="fas fa-fw fa-clock"></i> Published in: {{ time_formatter($step->created_at) }}</span>

        <ul>
          <li>
            <span><i class="fas fa-fw fa-tasks"></i> Steps</span>
            <div>
              <span>{{ count(\App\Models\InnerSteps::where('belongs_to', $step->h_id)->get()) }} Steps</span>
            </div>
          </li>

          <li>
            <span><i class="fas fa-fw fa-link"></i> Tags</span>
            <div>
              @foreach(explode(',', $step->h_tags) as $t)
                <span>{{ $t }}</span>
              @endforeach
            </div>
          </li>

          <li>
            <span><i class="fas fa-fw fa-search"></i> Keywords</span>
            <div>
              @foreach(explode(',', $step->h_keywords) as $t)
                <span>{{ $t }}</span>
              @endforeach
            </div>
          </li>

          <li>
            <span><i class="fas fa-fw fa-check"></i> Actions</span>
            <div>
              <a href="{{ route('profile.howto.add.step', $step->h_id) }}" class="button ui green"><i class="fas fa-fw fa-plus"></i></a>
              <a href="{{ route('profile.howto.delete', $step->h_id) }}" class="button ui red"><i class="fas fa-fw fa-trash"></i></a>
              <a href="{{ route('profile.howto.update', $step->h_id) }}" class="button ui primary"><i class="fas fa-fw fa-wrench"></i></a>
              <a href="{{ route('profile.howto.view', $step->h_id) }}" class="button ui"><i class="fas fa-fw fa-eye"></i></a>
            </div>
          </li>
        </ul>

      </div>

    @endforeach

    @php
      $steps = $steps->toArray();
      array_pop($steps['links']);
      array_shift($steps['links']);
    @endphp

    @if (count($steps['links']) > 1)
      <div class="ui pagination default-pagination menu ">
        @if (!is_null($steps['prev_page_url']))
          <a class="item" href="{{ $steps['prev_page_url'] }}"><i class="fas fa-fw fa-angle-left"></i></a>
        @endif
        @foreach ($steps['links'] as $l)
          <a class="item @if ($l['active']) active @endif" href="{{ $l['url'] }}">{{ $l['label'] }}</a>
        @endforeach
        @if (!is_null($steps['next_page_url']))
          <a class="item" href="{{ $steps['next_page_url'] }}"><i class="fas fa-fw fa-angle-right"></i></a>
        @endif
      </div>
    @endif

  </div>

</div>

@endsection
