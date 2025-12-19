<!doctype html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registracija | Smrčak DOO</title>

    <!-- Bootstrap 5 (CDN) -->
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
            --graybtn:#E5E7EB;
        }

        body{ background: var(--bg); }

        .topbar{ padding: 28px 32px; }
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

        .card-wrap{
            width: 420px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: var(--card);
            box-shadow: 0 10px 20px rgba(0,0,0,.06);
            padding: 22px 26px 22px;
        }

        .title{
            font-size: 22px;
            font-weight: 600;
            text-align:center;
            margin-bottom: 14px;
        }

        .input-like{
            background: var(--input);
            border: 1px solid transparent;
            border-radius: 10px;
            height: 42px;
            font-size: 13px;
        }
        .input-like:focus{
            background: var(--input);
            border-color: rgba(47,107,58,.25);
            box-shadow: 0 0 0 .2rem rgba(47,107,58,.12);
        }

        .section-label{
            font-size: 13px;
            color:#111;
            margin: 10px 0 6px;
            font-weight: 600;
        }

        .role-list .form-check{ margin-bottom: 6px; }
        .role-list .form-check-label{ font-size: 13px; color:#111; }

        .hint{ font-size: 12px; color: var(--muted); margin-top: 10px; }

        .btn-green{
            background: var(--green);
            border-color: var(--green);
            border-radius: 12px;
            height: 42px;
            font-weight: 600;
            font-size: 13px;
        }
        .btn-green:hover{
            background: var(--green-dark);
            border-color: var(--green-dark);
        }

        .btn-gray{
            background: var(--graybtn);
            border-color: var(--graybtn);
            border-radius: 12px;
            height: 42px;
            font-weight: 600;
            font-size: 13px;
            color:#111;
        }
        .btn-gray:hover{
            filter: brightness(.97);
        }

        .back-link{
            text-align:center;
            margin-top: 12px;
            font-size: 13px;
        }
        .back-link a{
            color: var(--green);
            text-decoration:none;
            font-weight: 600;
        }
        .back-link a:hover{ text-decoration: underline; }
    </style>
</head>

<body>

<div class="topbar">
    <div class="brand">🌲 Smrčak DOO Ivanjica</div>
</div>

<div class="center-wrap">
    <div class="card-wrap">
        <div class="title">Registracija novog korisnika</div>

        @if ($errors->any())
            <div class="alert alert-danger py-2 small mb-3">
                Proveri unete podatke.
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-2">
                <input type="text" name="ime" class="form-control input-like" placeholder="Ime" value="{{ old('ime') }}">
            </div>

            <div class="mb-2">
                <input type="text" name="prezime" class="form-control input-like" placeholder="Prezime" value="{{ old('prezime') }}">
            </div>

            <div class="mb-2">
                <input type="email" name="email" class="form-control input-like" placeholder="Korisničko ime / Email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-2">
                <input type="password" name="password" class="form-control input-like" placeholder="Lozinka" required>
            </div>

            <div class="mb-2">
                <input type="password" name="password_confirmation" class="form-control input-like" placeholder="Potvrda lozinke" required>
            </div>

            <div class="section-label">Uloga:</div>
            <div class="role-list">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="uloge[]" value="dobavljac" id="r1">
                    <label class="form-check-label" for="r1">Dobavljač</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="uloge[]" value="operater_otkupa" id="r2">
                    <label class="form-check-label" for="r2">Operater otkupa</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="uloge[]" value="tehnicar_prerade" id="r3">
                    <label class="form-check-label" for="r3">Tehničar prerade</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="uloge[]" value="radnik_hladnjace" id="r4">
                    <label class="form-check-label" for="r4">Radnik u hladnjači</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="uloge[]" value="finansijski_admin" id="r5">
                    <label class="form-check-label" for="r5">Finansijski administrator</label>
                </div>
            </div>

            <div class="hint mt-2">Ako je izabrano Dobavljač:</div>

            <div class="row g-2 mt-1">
                <div class="col-6">
                    <input type="text" name="pib" class="form-control input-like" placeholder="PIB" value="{{ old('pib') }}">
                </div>
                <div class="col-6">
                    <input type="text" name="mesto" class="form-control input-like" placeholder="Mesto" value="{{ old('mesto') }}">
                </div>
            </div>

            <div class="row g-2 mt-3">
                <div class="col-6">
                    <button class="btn btn-green w-100" type="submit">Registruj se</button>
                </div>
                <div class="col-6">
                    <a class="btn btn-gray w-100" href="{{ route('login') }}">Otkaži</a>
                </div>
            </div>

            <div class="back-link">
                <a href="{{ route('login') }}">Već imaš nalog? Prijavi se</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
