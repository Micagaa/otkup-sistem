<!doctype html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prijava | Smrčak DOO</title>

    <!-- Bootstrap 5 (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root{
            --bg:#F4F6F3;          /* pozadina kao na figmi */
            --card:#FFFFFF;        /* kartica */
            --muted:#6b7280;
            --input:#E6F0E6;       /* svetlo zelena polja */
            --green:#2F6B3A;       /* dugme */
            --green-dark:#25562E;
            --border:#E7E7E7;
        }

        body{ background: var(--bg); }

        .topbar{
            padding: 28px 32px;
        }
        .brand{
            font-size: 22px;
            font-weight: 600;
            color:#111;
            display:flex;
            align-items:center;
            gap:10px;
        }

        .center-wrap{
            min-height: calc(100vh - 90px);
            display:flex;
            align-items:center;
            justify-content:center;
            padding: 24px 12px;
        }

        .login-card{
            width: 380px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--card);
            box-shadow: 0 10px 20px rgba(0,0,0,.06);
            padding: 26px 26px 22px;
        }

        .title{
            font-size: 24px;
            font-weight: 600;
            text-align:center;
            margin-bottom: 18px;
        }

        .input-like{
            background: var(--input);
            border: 1px solid transparent;
            border-radius: 10px;
            height: 44px;
            text-align:center;
            font-size: 14px;
        }
        .input-like:focus{
            background: var(--input);
            border-color: rgba(47,107,58,.25);
            box-shadow: 0 0 0 .2rem rgba(47,107,58,.12);
        }

        .btn-green{
            background: var(--green);
            border-color: var(--green);
            border-radius: 12px;
            height: 44px;
            font-weight: 600;
        }
        .btn-green:hover{
            background: var(--green-dark);
            border-color: var(--green-dark);
        }

        .links{
            text-align:center;
            margin-top: 14px;
            font-size: 13px;
        }
        .links a{
            color: var(--green);
            text-decoration: none;
            font-weight: 600;
        }
        .links a:hover{ text-decoration: underline; }
    </style>
</head>

<body>

    <!-- Header gore levo (kao na figmi) -->
    <div class="topbar">
        <div class="brand">🌲 Smrčak DOO Ivanjica</div>
    </div>

    <!-- Centrirana kartica -->
    <div class="center-wrap">
        <div class="login-card">

            <div class="title">Prijava</div>

            @if ($errors->any())
                <div class="alert alert-danger py-2 small mb-3">
                    Pogrešan email ili lozinka.
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <input
                        type="text"
                        name="email"
                        class="form-control input-like"
                        placeholder="Korisničko ime / Email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                </div>

                <div class="mb-3">
                    <input
                        type="password"
                        name="password"
                        class="form-control input-like"
                        placeholder="Lozinka"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-green w-100">
                    Prijavi se
                </button>

                <div class="links">
                    @if (Route::has('register'))
                        <div class="mt-2">
                            Nemaš nalog? <a href="{{ route('register') }}">Registruj se</a>
                        </div>
                    @endif

                    @if (Route::has('password.request'))
                        <div class="mt-2">
                            <a href="{{ route('password.request') }}">Zaboravljena lozinka?</a>
                        </div>
                    @endif
                </div>

            </form>
        </div>
    </div>

</body>
</html>
