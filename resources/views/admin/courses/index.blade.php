@extends('layouts.admin')
@section('title', 'Courses')
@section('content')
  <div class="articles-page section">
    <h1 class="heading"><i class="fas fa-fw fa-play"></i> Courses</h1>
    <livewire:admin.courses.display-courses />
  </div>
@endsection

@section('scripts')

@endsection
