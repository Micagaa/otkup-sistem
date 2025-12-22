@extends('layouts.admin', ['title' => 'Kontrola kvaliteta'])

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <h3 class="mb-0">Kontrola kvaliteta</h3>
        <div class="text-muted small">Serije koje čekaju ili imaju rezultat kontrole.</div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-12 col-md-4">
                <label class="form-label">Pretraga</label>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                       placeholder="ID serije / vrsta ploda / faza">
            </div>

            <div class="col-12 col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">(podrazumevano: na_kontroli)</option>
                    @foreach($statusi as $st)
                        <option value="{{ $st }}" @selected(request('status') === $st)>{{ $st }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-5 d-flex gap-2">
                <button class="btn btn-success px-4">Primeni</button>
                <a href="{{ route('qc.index') }}" class="btn btn-outline-secondary px-4">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                <tr>
                    <th style="width:90px;">ID</th>
                    <th>Plod</th>
                    <th style="width:160px;">Faza</th>
                    <th style="width:160px;">Status</th>
                    <th style="width:160px;">Datum početka</th>
                    <th style="width:140px;" class="text-end">Akcija</th>
                </tr>
                </thead>
                <tbody>
                @forelse($serije as $s)
                    <tr>
                        <td class="fw-semibold">#{{ $s->id }}</td>
                        <td>{{ $s->otkup?->vrsta_ploda ?? '—' }}</td>
                        <td>{{ $s->faza }}</td>
                        <td>
                            @php
                                $badge = match($s->status_kvaliteta){
                                    'ispravno' => 'success',
                                    'neispravno' => 'danger',
                                    default => 'warning'
                                };
                            @endphp
                            <span class="badge text-bg-{{ $badge }}">{{ $s->status_kvaliteta }}</span>
                        </td>
                        <td>{{ $s->datum_pocetka ? \Carbon\Carbon::parse($s->datum_pocetka)->format('d.m.Y') : '—' }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-success"
                               href="{{ route('qc.edit', $s) }}">
                                Kontroliši
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Nema serija za prikaz.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if(method_exists($serije, 'links'))
        <div class="card-footer bg-white">
            {{ $serije->links() }}
        </div>
    @endif
</div>
@endsection
