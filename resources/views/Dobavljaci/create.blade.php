@extends('layouts.admin', ['title' => 'Novi dobavljač'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Novi dobavljač</h3>
    <a href="{{ route('dobavljaci.index') }}" class="btn btn-outline-secondary">Nazad</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('dobavljaci.store') }}">
            @csrf
            @include('dobavljaci.partials.form', ['dobavljac' => null])
            <button class="btn btn-success">Sačuvaj</button>
        </form>
    </div>
</div>
@endsection
