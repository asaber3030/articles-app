@extends('layouts.admin')

@section('title', 'Delete This Article')

@section('content')

  <div class="section">
    <h1 class="heading _300"><i class="fas fa-fw fa-trash"></i> Delete Course <strong>"{{ $course->course_title }}" ?</strong></h1>
    <div class="confirmation-message">
      <img src="{{ asset('icons/delete.svg') }}" alt="">
      <h2>Are you sure that you want to delete this course temporary?</h2>
      <p><i class="fas fa-fw fa-info-circle mr-5"></i> Note: That you can restore it later. This action will just make the deletion is temporary!</p>
      <form method="post">
        @csrf
        <button class="ui button red"><i class="fas fa-fw fa-trash"></i> Delete</button>
        <a class="ui button" href="{{ route('admin.courses') }}"><i class="fas fa-fw fa-times"></i> Cancel</a>
      </form>
    </div>
  </div>

@endsection
