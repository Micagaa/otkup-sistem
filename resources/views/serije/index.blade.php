@extends('layouts.admin', ['title' => 'Prerada'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-0">Pregled prerada</h3>
        <small class="text-muted">Evidencija serija prerade</small>
    </div>
    <a href="{{ route('serije.create') }}" class="btn btn-success">+ Nova prerada</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm mb-3">
    <div class="card-body">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Pretraga</label>
                <input name="search" value="{{ request('search') }}" class="form-control" placeholder="faza / status / plod...">
            </div>
            <div class="col-md-3">
                <label class="form-label">Faza</label>
                <select name="faza" class="form-select">
                    <option value="">Sve</option>
                    @foreach($faze as $f)
                        <option value="{{ $f }}" @selected(request('faza') === $f)>{{ $f }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Status kvaliteta</label>
                <select name="status_kvaliteta" class="form-select">
                    <option value="">Sve</option>
                    @foreach($statusi as $st)
                        <option value="{{ $st }}" @selected(request('status_kvaliteta') === $st)>{{ $st }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button class="btn btn-success w-100">Primeni</button>
                <a href="{{ route('serije.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Otkup</th>
                    <th>Faza</th>
                    <th>Status</th>
                    <th>Početak</th>
                    <th>Završetak</th>
                    <th class="text-end">Akcije</th>
                </tr>
                </thead>
                <tbody>
                @forelse($serije as $s)
                    <tr>
                        <td class="fw-semibold">{{ $s->id }}</td>
                        <td>
                            #{{ $s->otkup_id }}
                            @if($s->otkup?->vrsta_ploda)
                                <span class="text-muted">— {{ $s->otkup->vrsta_ploda }}</span>
                            @endif
                        </td>
                        <td>{{ $s->faza }}</td>
                        <td>{{ $s->status_kvaliteta }}</td>
                        <td>{{ \Carbon\Carbon::parse($s->datum_pocetka)->format('d.m.Y') }}</td>
                        <td>{{ $s->datum_zavrsetka ? \Carbon\Carbon::parse($s->datum_zavrsetka)->format('d.m.Y') : '—' }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-success" href="{{ route('serije.show', $s) }}">Detalji</a>
                            <a class="btn btn-sm btn-outline-success" href="{{ route('serije.edit', $s) }}">Izmeni</a>
                            <form action="{{ route('serije.destroy', $s) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Obrisati preradu?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Obriši</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-muted">Nema evidentiranih prerada.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <div>{{ $serije->links() }}</div>
            <small class="text-muted">Ukupno: {{ $serije->total() }}</small>
        </div>
    </div>
</div>
@endsection
