@extends('layouts.admin', ['title' => 'Evidentiranje prerade'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-0">Forma za evidentiranje prerade</h3>
        <small class="text-muted">Unesite podatke o preradi šumskih plodova.</small>
    </div>
    <a href="{{ route('serije.index') }}" class="btn btn-outline-secondary">Nazad</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('serije.store') }}" class="mx-auto" style="max-width: 760px;">
            @csrf
            @include('serije.partials.form', ['serija' => null, 'otkupi' => $otkupi, 'faze' => $faze, 'statusi' => $statusi])

            <div class="d-flex gap-2 justify-content-center mt-3">
                <button class="btn btn-success px-5">Sačuvaj</button>
                <button type="reset" class="btn btn-outline-secondary px-5">Resetuj</button>
                <a href="{{ route('serije.index') }}" class="btn btn-outline-dark px-5">Otkaži</a>
            </div>
        </form>
    </div>
</div>
@endsection
