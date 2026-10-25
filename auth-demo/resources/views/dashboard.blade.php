<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <header class="topbar">
        <span class="topbar__app">{{ config('app.name') }}</span>
        <span class="topbar__user">{{ Auth::user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Log out</button>
        </form>
    </header>

    <main class="container">
        <h1>Dashboard</h1>
        <p>You are logged in as <strong>{{ Auth::user()->email }}</strong>.</p>
        <p>This page is protected by the <code>auth</code> middleware — try it while logged out.</p>
    </main>
</body>

</html>