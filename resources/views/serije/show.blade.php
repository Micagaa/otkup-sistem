@extends('layouts.admin', ['title' => 'Detalji prerade'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Detalji prerade</h3>
    <div class="d-flex gap-2">
        <a href="{{ route('serije.edit', $serija) }}" class="btn btn-outline-success">Izmeni</a>
        <a href="{{ route('serije.index') }}" class="btn btn-outline-secondary">Nazad</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-3">ID</dt><dd class="col-sm-9">{{ $serija->id }}</dd>

            <dt class="col-sm-3">Otkup</dt>
            <dd class="col-sm-9">
                #{{ $serija->otkup_id }}
                @if($serija->otkup?->vrsta_ploda)
                    <span class="text-muted">— {{ $serija->otkup->vrsta_ploda }}</span>
                @endif
            </dd>

            <dt class="col-sm-3">Faza</dt><dd class="col-sm-9">{{ $serija->faza }}</dd>
            <dt class="col-sm-3">Status kvaliteta</dt><dd class="col-sm-9">{{ $serija->status_kvaliteta }}</dd>

            <dt class="col-sm-3">Napomena</dt>
            <dd class="col-sm-9">{{ $serija->napomena_kvaliteta ?? '—' }}</dd>

            <dt class="col-sm-3">Datum početka</dt><dd class="col-sm-9">{{ \Carbon\Carbon::parse($serija->datum_pocetka)->format('d.m.Y') }}</dd>
            <dt class="col-sm-3">Datum završetka</dt><dd class="col-sm-9">{{ $serija->datum_zavrsetka ? \Carbon\Carbon::parse($serija->datum_zavrsetka)->format('d.m.Y') : '—' }}</dd>
        </dl>
    </div>
</div>
@endsection
