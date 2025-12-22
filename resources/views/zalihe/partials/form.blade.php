@php
    $value = fn($key, $default = '') => old($key, $zaliha?->{$key} ?? $default);
@endphp

<div class="row g-3 align-items-center">

    <div class="col-md-4 text-muted small">ID serije:</div>
    <div class="col-md-8">
        <select name="serija_prerade_id" id="serija_prerade_id" class="form-select">
            <option value="">— Nije povezano —</option>

            @foreach($serije as $s)
                <option
                    value="{{ $s->id }}"
                    data-vrsta="{{ $s->otkup?->vrsta_ploda ?? '' }}"
                    data-kolicina="{{ $s->otkup?->kolicina_kg ?? '' }}"
                    @selected((string)$value('serija_prerade_id') === (string)$s->id)
                >
                    {{ $s->id_serije ?? ('SER-' . $s->id) }}
                </option>
            @endforeach
        </select>

        @error('serija_prerade_id')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror

        <div class="text-muted small mt-1">
            Izbor serije automatski popunjava vrstu proizvoda i količinu.
        </div>
    </div>

    <div class="col-md-4 text-muted small">Vrsta proizvoda:</div>
    <div class="col-md-8">
        <input
            name="vrsta_proizvoda"
            id="vrsta_proizvoda"
            class="form-control"
            placeholder="Borovnica / Malina / Smrčak..."
            value="{{ $value('vrsta_proizvoda') }}"
        >
        @error('vrsta_proizvoda')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 text-muted small">Količina (kg):</div>
    <div class="col-md-8">
        <input
            name="kolicina_kg"
            id="kolicina_kg"
            type="number"
            step="0.01"
            class="form-control"
            placeholder="npr. 120"
            value="{{ $value('kolicina_kg') }}"
        >
        @error('kolicina_kg')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 text-muted small">Datum prijema:</div>
    <div class="col-md-8">
        <input
            name="datum_prijema"
            type="date"
            class="form-control"
            value="{{ $value('datum_prijema') }}"
        >
        @error('datum_prijema')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 text-muted small">Rok upotrebe:</div>
    <div class="col-md-8">
        <input
            name="rok_upotrebe"
            type="date"
            class="form-control"
            value="{{ $value('rok_upotrebe') }}"
        >
        @error('rok_upotrebe')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 text-muted small">Pozicija u hladnjači:</div>
    <div class="col-md-8">
        <input
            name="pozicija"
            class="form-control"
            placeholder="npr. R1 - S1"
            value="{{ $value('pozicija') }}"
        >
        @error('pozicija')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

</div>
