@extends('layouts.admin', ['title' => 'Novi otkup'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-0">Evidentiranje novog otkupa</h3>
        <small class="text-muted">Unesite podatke o otkupu šumskih plodova.</small>
    </div>
    <a href="{{ route('otkupi.index') }}" class="btn btn-outline-secondary">Nazad</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">Proveri unete podatke.</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('otkupi.store') }}" class="mx-auto" style="max-width: 720px;">
            @csrf
            @include('otkupi.partials.form', ['otkup' => null, 'dobavljaci' => $dobavljaci])

            <div class="d-flex gap-2 justify-content-center mt-3">
                <button class="btn btn-success px-5">Sačuvaj otkup</button>
                <a href="{{ route('otkupi.index') }}" class="btn btn-danger px-5">Otkaži</a>
            </div>

            <div class="alert alert-success mt-3 mb-0">
                Napomena: Ukupna vrednost se računa automatski na osnovu unete količine i cene.
            </div>
        </form>
    </div>
</div>
@endsection
