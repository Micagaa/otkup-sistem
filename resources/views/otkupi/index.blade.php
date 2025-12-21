@extends('layouts.admin', ['title' => 'Otkupi'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-0">Pregled svih otkupa</h3>
        <small class="text-muted">Operater otkupa – evidencija i pregled</small>
    </div>
    <a href="{{ route('otkupi.create') }}" class="btn btn-success">+ Novi otkup</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm mb-3">
    <div class="card-body">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Pretraži dobavljača</label>
                <input name="search" value="{{ request('search') }}" class="form-control" placeholder="Ime/PIB...">
            </div>

            <div class="col-md-3">
                <label class="form-label">Vrsta ploda</label>
                <select name="vrsta_ploda" class="form-select">
                    <option value="">Izaberi plod</option>
                    @foreach($vrstePloda as $vp)
                        <option value="{{ $vp }}" @selected(request('vrsta_ploda') === $vp)>{{ $vp }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label">Od</label>
                <input type="date" name="from" value="{{ request('from') }}" class="form-control">
            </div>

            <div class="col-md-2">
                <label class="form-label">Do</label>
                <input type="date" name="to" value="{{ request('to') }}" class="form-control">
            </div>

            <div class="col-md-1 d-grid">
                <button class="btn btn-success">Primeni</button>
            </div>

            <div class="col-md-12">
                <a href="{{ route('otkupi.index') }}" class="btn btn-outline-secondary btn-sm">Poništi filter</a>
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
                    <th>Dobavljač</th>
                    <th>Vrsta ploda</th>
                    <th>Količina (kg)</th>
                    <th>Vrednost</th>
                    <th>Datum</th>
                    <th>Status isplate</th>
                    <th class="text-end">Akcija</th>
                </tr>
                </thead>
                <tbody>
                @forelse($otkupi as $o)
                    @php $vrednost = (float)$o->kolicina_kg * (float)$o->cena_po_kg; @endphp
                    <tr>
                        <td class="fw-semibold">{{ $o->dobavljac?->naziv }}</td>
                        <td>{{ $o->vrsta_ploda }}</td>
                        <td>{{ $o->kolicina_kg }}</td>
                        <td>{{ number_format($vrednost, 0, ',', '.') }} RSD</td>
                        <td>{{ \Carbon\Carbon::parse($o->datum_otkupa)->format('d.m.Y') }}</td>
                        <td>
                            @if($o->status_isplate === 'isplaceno')
                                <span class="badge text-bg-success">Isplaćeno</span>
                            @else
                                <span class="badge text-bg-secondary">Na čekanju</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-success" href="{{ route('otkupi.show', $o) }}">Detalji</a>
                            <a class="btn btn-sm btn-outline-success" href="{{ route('otkupi.edit', $o) }}">Izmeni</a>
                            <form action="{{ route('otkupi.destroy', $o) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Obrisati otkup?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Obriši</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-muted">Nema otkupa.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <div>{{ $otkupi->links() }}</div>
            <small class="text-muted">Ukupno: {{ $otkupi->total() }} zapisa</small>
        </div>
    </div>
</div>
@endsection
