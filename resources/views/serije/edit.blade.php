@extends('layouts.admin', ['title' => 'Izmena prerade'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Izmena prerade</h3>
    <a href="{{ route('serije.index') }}" class="btn btn-outline-secondary">Nazad</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('serije.update', $serija) }}" class="mx-auto" style="max-width: 760px;">
            @csrf
            @method('PUT')
            @include('serije.partials.form', ['serija' => $serija, 'otkupi' => $otkupi, 'faze' => $faze, 'statusi' => $statusi])

            <div class="d-flex gap-2 justify-content-center mt-3">
                <button class="btn btn-success px-5">Sačuvaj</button>
                <a href="{{ route('serije.index') }}" class="btn btn-outline-secondary px-5">Otkaži</a>
            </div>
        </form>
    </div>
</div>
@endsection
