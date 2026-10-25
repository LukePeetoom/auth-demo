<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Auth') — {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body class="auth-body">
    <main class="auth-card">
        <h1 class="auth-card__title">@yield('title')</h1>

        @if (session('status'))
        <div class="alert alert--success">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
        <div class="alert alert--error">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @yield('content')
    </main>
</body>

</html>