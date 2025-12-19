@extends('layouts.admin', ['title' => 'Detalji dobavljača'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Detalji dobavljača</h3>
    <div class="d-flex gap-2">
        <a href="{{ route('dobavljaci.edit', $dobavljac) }}" class="btn btn-outline-success">Izmeni</a>
        <a href="{{ route('dobavljaci.index') }}" class="btn btn-outline-secondary">Nazad</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-3">Naziv</dt><dd class="col-sm-9">{{ $dobavljac->naziv }}</dd>
            <dt class="col-sm-3">PIB</dt><dd class="col-sm-9">{{ $dobavljac->pib }}</dd>
            <dt class="col-sm-3">Mesto</dt><dd class="col-sm-9">{{ $dobavljac->mesto }}</dd>
            <dt class="col-sm-3">Telefon</dt><dd class="col-sm-9">{{ $dobavljac->telefon }}</dd>
            <dt class="col-sm-3">Email</dt><dd class="col-sm-9">{{ $dobavljac->email }}</dd>
        </dl>
    </div>
</div>
@endsection
