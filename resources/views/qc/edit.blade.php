@extends('layouts.admin', ['title' => 'Kontrola kvaliteta'])

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <h3 class="mb-0">Forma za kontrolu kvaliteta</h3>
        <div class="text-muted small">Serija #{{ $serija->id }} — {{ $serija->otkup?->vrsta_ploda ?? '—' }}</div>
    </div>
    <a href="{{ route('qc.index') }}" class="btn btn-outline-secondary">Nazad</a>
</div>

<div class="card shadow-sm mx-auto" style="max-width: 820px; border-radius:16px;">
    <div class="card-body p-4">

        <div class="mb-3">
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="form-label">ID serije</label>
                    <input class="form-control" value="SER-{{ \Carbon\Carbon::parse($serija->datum_pocetka)->format('Y') }}-{{ str_pad($serija->id, 3, '0', STR_PAD_LEFT) }}" disabled>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Vrsta ploda</label>
                    <input class="form-control" value="{{ $serija->otkup?->vrsta_ploda ?? '' }}" disabled>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Količina (kg)</label>
                    <input class="form-control" value="{{ $serija->otkup?->kolicina_kg ?? '' }}" disabled>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('qc.update', $serija) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Status kvaliteta</label>
                <div class="d-flex gap-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_kvaliteta" id="ispravno" value="ispravno"
                               @checked(old('status_kvaliteta', $serija->status_kvaliteta) === 'ispravno')>
                        <label class="form-check-label" for="ispravno">Ispravno</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_kvaliteta" id="neispravno" value="neispravno"
                               @checked(old('status_kvaliteta', $serija->status_kvaliteta) === 'neispravno')>
                        <label class="form-check-label" for="neispravno">Neispravno</label>
                    </div>
                </div>
                @error('status_kvaliteta') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Napomena</label>
                <textarea class="form-control" name="napomena_kvaliteta" rows="4"
                          placeholder="Unesite zapažanja kontrole kvaliteta...">{{ old('napomena_kvaliteta', $serija->napomena_kvaliteta) }}</textarea>
                @error('napomena_kvaliteta') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex gap-2 justify-content-center mt-4">
                <button class="btn btn-success px-4">Sačuvaj rezultate</button>
                <a href="{{ route('qc.index') }}" class="btn btn-outline-secondary px-4">Otkaži</a>
            </div>

            <div class="text-muted small mt-3 text-center">
                Napomena: Ako je rezultat neispravan, serija ostaje označena kao <b>neispravno</b> (vidljivo u listi).
            </div>
        </form>
    </div>
</div>
@endsection
