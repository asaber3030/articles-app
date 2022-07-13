@extends('layouts.user')
@section('title', 'Login')
@section('content')

  <div class="login-page">
    <h1>Login & be one of us!</h1>
    <form method="POST" action="{{ route('login') }}" class="ui form">
      <img src="{{ asset('icons/login.png') }}" alt="">
      @csrf
      <div class="ui field">
        <input type="text" placeholder="Enter your E-mail Address" name="email" value="{{ old('email') }}">
        @error('email')<span class="error">{{ $message }}</span>@enderror
      </div>
      <div class="ui field">
        <input type="password" placeholder="Enter your Password" name="password" value="{{ old('password') }}">
        @error('password')<span class="error">{{ $message }}</span>@enderror
      </div>
      <div class="ui field checkbox-field">
        <input type="checkbox" id="rem-me-in" name="remember">
        <label for="rem-me-in">Remember me?</label>
      </div>
      <div class="field links">
        <a href="{{ route('register') }}">I don't have an account? Register now.</a>
        <a href="{{ route('password.request') }}">I've forgot my password. Reset</a>
      </div>
      <div class="ui field">
        <button class="ui button primary"><i class="fas fa-fw fa-sign-in-alt"></i> Submit & Login</button>
      </div>
    </form>
  </div>
@endsection
