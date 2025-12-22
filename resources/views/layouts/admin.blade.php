<!doctype html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Smrčak DOO' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
        <a class="navbar-brand fw-semibold" href="{{ route('dashboard') }}">🌲 Smrčak DOO Ivanjica</a>

        <div class="d-flex align-items-center gap-2">
            <span class="text-white-50 small">{{ auth()->user()->name ?? '' }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-light btn-sm">Odjava</button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <aside class="col-12 col-md-2 bg-white border-end min-vh-100 p-0">
            <div class="list-group list-group-flush rounded-0">
                <a class="list-group-item list-group-item-action" href="{{ route('dobavljaci.index') }}">Dobavljači</a>
                <a class="list-group-item list-group-item-action" href="{{ route('otkupi.index') }}">Otkupi</a>
                <a class="list-group-item list-group-item-action" href="{{ route('serije.index') }}">Serije prerade</a>
                <a href="{{ route('qc.index') }}" class="list-group-item">
                    Kontrola kvaliteta
                </a>
                <a class="list-group-item list-group-item-action" href="{{ route('zalihe.index') }}">Zalihe</a>
            </div>
        </aside>

        <main class="col-12 col-md-10 p-4">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
