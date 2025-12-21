@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
      
        
    </div>

    <div class="text-center mb-4">
        <h2 class="mb-1">Pregled stanja zaliha</h2>
        <div class="text-muted small">Pretraga i uvid u trenutno stanje robe u skladištu</div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm mb-4" style="border-radius:16px;">
        <div class="card-body">
            <h6 class="mb-3">Pretraga</h6>

            <form method="GET" action="{{ route('zalihe.index') }}" class="row g-3 align-items-center">
                <div class="col-md-6">
                    <label class="form-label small text-muted mb-1">Pretraga:</label>
                    <input type="text" name="q" value="{{ request('q') }}"
                           class="form-control"
                           placeholder="Unesite naziv proizvoda ili poziciju...">
                </div>

                <div class="col-md-3 d-flex gap-2 mt-4">
                    <button class="btn btn-success">Pretraži</button>
                    <a href="{{ route('zalihe.index') }}" class="btn btn-outline-secondary">Osveži</a>
                </div>

                <div class="col-md-3 d-flex justify-content-end mt-4">
                    <a href="{{ route('zalihe.create') }}" class="btn btn-success">Prijem robe</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm" style="border-radius:16px;">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead style="background:#e8f1e6;">
                        <tr>
                            <th style="border-top-left-radius:12px;">ID</th>
                            <th>Vrsta proizvoda</th>
                            <th>Količina (kg)</th>
                            <th>Rok upotrebe</th>
                            <th>Pozicija</th>
                            <th style="border-top-right-radius:12px;">Akcija</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($zalihe as $z)
                            <tr>
                                <td>{{ $z->id }}</td>
                                <td>{{ $z->vrsta_proizvoda }}</td>
                                <td>{{ $z->kolicina_kg }}</td>
                                <td>{{ $z->rok_upotrebe ? \Carbon\Carbon::parse($z->rok_upotrebe)->format('d.m.Y') : '-' }}</td>
                                <td>{{ $z->pozicija ?? '-' }}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('zalihe.show', $z) }}" class="btn btn-outline-secondary btn-sm">Detalji</a>
                                    <a href="{{ route('zalihe.edit', $z) }}" class="btn btn-success btn-sm">Izmeni</a>

                                    <form action="{{ route('zalihe.destroy', $z) }}" method="POST"
                                          onsubmit="return confirm('Obrisati zapis?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm">Obriši</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-muted">Nema zapisa.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>{{ $zalihe->links() }}</div>
                <div class="text-muted small">Ukupno: {{ $zalihe->total() }} zapisa</div>
            </div>

        </div>
    </div>

</div>
@endsection
