@extends('layouts.admin', ['title' => 'Izmena dobavljača'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Izmena dobavljača</h3>
    <a href="{{ route('dobavljaci.index') }}" class="btn btn-outline-secondary">Nazad</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('dobavljaci.update', $dobavljac) }}">
            @csrf
            @method('PUT')
            @include('dobavljaci.partials.form', ['dobavljac' => $dobavljac])
            <button class="btn btn-success">Sačuvaj izmene</button>
        </form>
    </div>
</div>
@endsection
