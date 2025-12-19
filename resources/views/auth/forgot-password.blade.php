<!doctype html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zaboravljena lozinka | Smrčak DOO</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root{
            --bg:#F4F6F3;
            --card:#FFFFFF;
            --muted:#6b7280;
            --input:#E6F0E6;
            --green:#2F6B3A;
            --green-dark:#25562E;
            --border:#E7E7E7;
        }
        body{ background: var(--bg); }

        .topbar{ padding: 28px 32px; }
        .brand{
            font-size: 22px;
            font-weight: 600;
            display:flex;
            align-items:center;
            gap:10px;
        }
        .center-wrap{
            min-height: calc(100vh - 90px);
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .card-wrap{
            width: 420px;
            background: var(--card);
            border-radius: 14px;
            border: 1px solid var(--border);
            box-shadow: 0 10px 20px rgba(0,0,0,.06);
            padding: 24px 26px;
        }
        .title{
            text-align:center;
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 6px;
        }
        .subtitle{
            text-align:center;
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 16px;
        }
        .input-like{
            background: var(--input);
            border-radius: 10px;
            border: 1px solid transparent;
            height: 42px;
            font-size: 13px;
        }
        .input-like:focus{
            background: var(--input);
            border-color: rgba(47,107,58,.25);
            box-shadow: 0 0 0 .2rem rgba(47,107,58,.12);
        }
        .btn-green{
            background: var(--green);
            border-color: var(--green);
            height: 42px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 13px;
        }
        .btn-green:hover{
            background: var(--green-dark);
            border-color: var(--green-dark);
        }
        .links{
            text-align:center;
            font-size: 13px;
            margin-top: 12px;
        }
        .links a{
            color: var(--green);
            font-weight: 600;
            text-decoration:none;
        }
        .links a:hover{ text-decoration: underline; }
    </style>
</head>

<body>

<div class="topbar">
    <div class="brand">🌲 Smrčak DOO Ivanjica</div>
</div>

<div class="center-wrap">
    <div class="card-wrap">
        <div class="title">Zaboravljena lozinka</div>
        <div class="subtitle">
            Unesi email adresu i poslaćemo ti link za reset lozinke.
        </div>

        @if (session('status'))
            <div class="alert alert-success py-2 small">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <input
                    type="email"
                    name="email"
                    class="form-control input-like"
                    placeholder="Korisničko ime / Email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-green w-100">
                Pošalji link za reset
            </button>

            <div class="links">
                <div class="mt-2">
                    <a href="{{ route('login') }}">Nazad na prijavu</a>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
