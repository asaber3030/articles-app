@extends('layouts.user')
@section('title', 'Delete step')
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <div class="delete-section second-section">

      <h1 class="heading"><i class="fas fa-fw fa-trash"></i> Delete step "{{ $step->step_title }}"</h1>

      <form method="post" class="delete-form ui form">

        @csrf

        <h1>Would you like to delete this step forever?</h1>
        <p>Once you delete it you cannot restore it again with any way! Be Careful.</p>

        <button type="submit" class="ui button red"><i class="fas fa-fw fa-trash"></i> Delete</button>
        <button type="button" goto="{{ route('profile.howto') }}" class="ui button primary"><i class="fas fa-fw fa-times"></i> Cancel</button>

      </form>

      <a href="{{ route('profile.howto.view', $step->belongs_to) }}" class="mt-10" style="display: block">View This Course</a>

    </div>

  </div>

@endsection
