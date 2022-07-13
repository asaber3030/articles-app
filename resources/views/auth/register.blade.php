@extends('layouts.user')
@section('title', 'Create An Account')
@section('content')

  <div class="register-page">

    <h1>Create An Account</h1>

    <form method="POST" action="{{ route('register') }}" class="ui form">

      @csrf
      <img src="{{ asset('icons/sign-up.svg') }}" alt="">

      <div class="ui field">
        <input type="text" placeholder="Unique Username" name="username" value="{{ old('username') }}">
        @error('username')<span class="error">{{ $message }}</span>@enderror
      </div>

      <div class="ui field">
        <input type="text" placeholder="Firstname" name="firstname" value="{{ old('firstname') }}">
        @error('firstname')<span class="error">{{ $message }}</span>@enderror
      </div>

      <div class="ui field">
        <input type="text" placeholder="Lastname" name="lastname" value="{{ old('lastname') }}">
        @error('lastname')<span class="error">{{ $message }}</span>@enderror
      </div>

      <div class="ui field">
        <input type="text" placeholder="E-mail Address" name="email" value="{{ old('email') }}">
        @error('email')<span class="error">{{ $message }}</span>@enderror
      </div>

      <div class="ui field">
        <input type="password" placeholder="Strong Password" name="password" value="{{ old('password') }}">
        @error('password')<span class="error">{{ $message }}</span>@enderror
      </div>

      <div class="field links">
        <a href="{{ route('login') }}">Already have an account? Register now.</a>
      </div>

      <div class="ui field">
        <button class="ui button primary"><i class="fas fa-fw fa-user-plus"></i> Create Account</button>
      </div>

    </form>

  </div>
@endsection
