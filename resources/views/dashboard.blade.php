@extends('layouts.admin', ['title' => 'Dashboard'])

@section('content')
<div class="row g-3">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-1">Dobrodošao u Smrčak DOO sistem</h4>
                <p class="text-muted mb-0">Otkup i prerada šumskih plodova – interna aplikacija za zaposlene.</p>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="small text-muted">Dobavljači</div>
                <div class="fs-4 fw-semibold">{{ \App\Models\Dobavljac::count() }}</div>
                <a class="btn btn-sm btn-outline-success mt-2" href="{{ route('dobavljaci.index') }}">Otvori</a>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="small text-muted">Otkupi</div>
                <div class="fs-4 fw-semibold">{{ \App\Models\Otkup::count() }}</div>
                <a class="btn btn-sm btn-outline-success mt-2" href="{{ route('otkupi.index') }}">Otvori</a>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="small text-muted">Serije prerade</div>
                <div class="fs-4 fw-semibold">{{ \App\Models\SerijaPrerade::count() }}</div>
                <a class="btn btn-sm btn-outline-success mt-2" href="{{ route('serije.index') }}">Otvori</a>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="small text-muted">Zalihe</div>
                <div class="fs-4 fw-semibold">{{ \App\Models\Zaliha::count() }}</div>
                <a class="btn btn-sm btn-outline-success mt-2" href="{{ route('zalihe.index') }}">Otvori</a>
            </div>
        </div>
    </div>
</div>
@endsection
