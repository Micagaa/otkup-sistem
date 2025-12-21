@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center gap-2">
            <span style="font-size:20px;">🌲</span>
            <h5 class="mb-0">Smrčak DOO Ivanjica</h5>
        </div>
        <a href="{{ route('zalihe.index') }}" class="text-decoration-none">Nazad</a>
    </div>

    <div class="text-center mb-4">
        <h2 class="mb-1">Izmena zalihe</h2>
        <div class="text-muted small">Ažuriraj podatke</div>
    </div>

    <div class="card shadow-sm mx-auto" style="max-width: 820px; border-radius:16px;">
        <div class="card-body p-4">

            <form method="POST" action="{{ route('zalihe.update', $zaliha) }}">
                @csrf
                @method('PUT')
                @include('zalihe.partials.form', ['zaliha' => $zaliha, 'serije' => $serije])

                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button class="btn btn-success px-4">Sačuvaj</button>
                    <a href="{{ route('zalihe.index') }}" class="btn btn-outline-secondary px-4">Otkaži</a>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection
