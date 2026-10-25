@extends('layouts.auth')

@section('title', 'Log in')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf

    <label for="email">Email</label>
    <input id="email" type="email" name="email"
        value="{{ old('email') }}" required autofocus autocomplete="username">

    <label for="password">Password</label>
    <input id="password" type="password" name="password"
        required autocomplete="current-password">

    <label class="remember">
        <input type="checkbox" name="remember"> Remember me
    </label>

    <button type="submit">Log in</button>
</form>

<p class="auth-alt">
    Don't have an account?
    <a href="{{ route('register') }}">Register</a>
</p>
@endsection