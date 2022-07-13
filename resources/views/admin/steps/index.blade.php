@extends('layouts.admin')
@section('title', 'HowTo Articles')
@section('content')
  <div class="howto-page section">
    <h1 class="heading"><i class="fas fa-fw fa-question-circle"></i> HowTo</h1>
    <livewire:admin.steps.display-steps />
  </div>
@endsection

@section('scripts')

@endsection
