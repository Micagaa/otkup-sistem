@extends('layouts.admin', ['title' => 'Detalji otkupa'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Detalji otkupa</h3>
    <div class="d-flex gap-2">
        <a href="{{ route('otkupi.edit', $otkup) }}" class="btn btn-outline-success">Izmeni</a>
        <a href="{{ route('otkupi.index') }}" class="btn btn-outline-secondary">Nazad</a>
    </div>
</div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-3">Dobavljač</dt>
            <dd class="col-sm-9">
                {{ $otkup->dobavljac?->naziv }}
                @if($otkup->dobavljac?->pib)
                    <span class="text-muted">(PIB: {{ $otkup->dobavljac->pib }})</span>
                @endif
            </dd>


            <dt class="col-sm-3">Vrsta ploda</dt>
            <dd class="col-sm-9">{{ $otkup->vrsta_ploda }}</dd>

            <dt class="col-sm-3">Količina (kg)</dt>
            <dd class="col-sm-9">{{ $otkup->kolicina_kg }}</dd>

            <dt class="col-sm-3">Cena/kg</dt>
            <dd class="col-sm-9">{{ $otkup->cena_po_kg }} RSD</dd>

            <dt class="col-sm-3">Ukupna vrednost</dt>
            <dd class="col-sm-9 fw-semibold">{{ number_format($vrednost, 0, ',', '.') }} RSD</dd>

            <dt class="col-sm-3">Datum otkupa</dt>
            <dd class="col-sm-9">{{ \Carbon\Carbon::parse($otkup->datum_otkupa)->format('d.m.Y') }}</dd>

            <dt class="col-sm-3">Status isplate</dt>
            <dd class="col-sm-9">{{ $otkup->status_isplate === 'isplaceno' ? 'Isplaćeno' : 'Na čekanju' }}</dd>
        </dl>
    </div>
</div>
@endsection
