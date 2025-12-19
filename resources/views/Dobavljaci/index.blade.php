@extends('layouts.admin', ['title' => 'Dobavljači'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Dobavljači</h3>
    <a href="{{ route('dobavljaci.create') }}" class="btn btn-success">+ Novi dobavljač</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th>Naziv</th>
                    <th>PIB</th>
                    <th>Mesto</th>
                    <th>Telefon</th>
                    <th>Email</th>
                    <th class="text-end">Akcije</th>
                </tr>
                </thead>
                <tbody>
                @forelse($dobavljaci as $d)
                    <tr>
                        <td class="fw-semibold">{{ $d->naziv }}</td>
                        <td>{{ $d->pib }}</td>
                        <td>{{ $d->mesto }}</td>
                        <td>{{ $d->telefon }}</td>
                        <td>{{ $d->email }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('dobavljaci.show', $d) }}">Detalji</a>
                            <a class="btn btn-sm btn-outline-success" href="{{ route('dobavljaci.edit', $d) }}">Izmeni</a>
                            <form action="{{ route('dobavljaci.destroy', $d) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Obrisati dobavljača?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Obriši</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-muted">Nema dobavljača.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{ $dobavljaci->links() }}
    </div>
</div>
@endsection
