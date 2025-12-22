@php $s = $serija; @endphp

<div class="row g-3">

    <div class="col-md-12">
        <label class="form-label">Otkup</label>
        <select name="otkup_id" class="form-select" required>
            <option value="">Izaberi otkup</option>
            @foreach($otkupi as $o)
                <option value="{{ $o->id }}" @selected(old('otkup_id', $s->otkup_id ?? '') == $o->id)>
                    #{{ $o->id }} — {{ $o->vrsta_ploda ?? 'plod' }} ({{ $o->datum_otkupa ?? '' }})
                </option>
            @endforeach
        </select>
        @error('otkup_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Faza prerade</label>
        <select class="form-select" name="faza" required>
            <option value="">Izaberi fazu</option>
            @foreach($faze as $f)
                <option value="{{ $f }}" @selected(old('faza', $s->faza ?? '') === $f)>{{ $f }}</option>
            @endforeach
        </select>
        @error('faza') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Datum početka</label>
        <input type="date" class="form-control" name="datum_pocetka"
               value="{{ old('datum_pocetka', isset($s->datum_pocetka) ? \Carbon\Carbon::parse($s->datum_pocetka)->format('Y-m-d') : '') }}" required>
        @error('datum_pocetka') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Datum završetka</label>
        <input type="date" class="form-control" name="datum_zavrsetka"
               value="{{ old('datum_zavrsetka', isset($s->datum_zavrsetka) ? \Carbon\Carbon::parse($s->datum_zavrsetka)->format('Y-m-d') : '') }}">
        @error('datum_zavrsetka') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

</div>
