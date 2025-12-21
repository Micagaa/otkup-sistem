@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center gap-2">
            <span style="font-size:20px;">🌲</span>
            <h5 class="mb-0">Smrčak DOO Ivanjica</h5>
        </div>
        <a href="{{ route('zalihe.index') }}" class="text-decoration-none">Nazad</a>
    </div>

    <div class="text-center mb-4">
        <h2 class="mb-1">Detalji zalihe</h2>
    </div>

    <div class="card shadow-sm mx-auto" style="max-width: 820px; border-radius:16px;">
        <div class="card-body p-4">

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="text-muted small">Serija</div>
                    <div class="fw-semibold">{{ $zaliha->serijaPrerade?->id ?? '-' }}</div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted small">Vrsta proizvoda</div>
                    <div class="fw-semibold">{{ $zaliha->vrsta_proizvoda }}</div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted small">Količina (kg)</div>
                    <div class="fw-semibold">{{ $zaliha->kolicina_kg }}</div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted small">Datum prijema</div>
                    <div class="fw-semibold">
                        {{ $zaliha->datum_prijema ? \Carbon\Carbon::parse($zaliha->datum_prijema)->format('d.m.Y') : '-' }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted small">Rok upotrebe</div>
                    <div class="fw-semibold">
                        {{ $zaliha->rok_upotrebe ? \Carbon\Carbon::parse($zaliha->rok_upotrebe)->format('d.m.Y') : '-' }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted small">Pozicija</div>
                    <div class="fw-semibold">{{ $zaliha->pozicija ?? '-' }}</div>
                </div>
            </div>

            <div class="d-flex gap-2 justify-content-center mt-4">
                <a href="{{ route('zalihe.edit', $zaliha) }}" class="btn btn-success px-4">Izmeni</a>
                <a href="{{ route('zalihe.index') }}" class="btn btn-outline-secondary px-4">Nazad</a>
            </div>

        </div>
    </div>

</div>
@endsection
