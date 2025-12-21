@extends('layouts.admin', ['title' => 'Izmena otkupa'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Izmena otkupa</h3>
    <a href="{{ route('otkupi.index') }}" class="btn btn-outline-secondary">Nazad</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('otkupi.update', $otkup) }}" class="mx-auto" style="max-width: 720px;">
            @csrf
            @method('PUT')
            @include('otkupi.partials.form', ['otkup' => $otkup, 'dobavljaci' => $dobavljaci])

            <div class="d-flex gap-2 justify-content-center mt-3">
                <button class="btn btn-success px-5">Sačuvaj izmene</button>
                <a href="{{ route('otkupi.index') }}" class="btn btn-outline-secondary px-5">Otkaži</a>
            </div>
        </form>
    </div>
</div>
@endsection
