@php
    $o = $otkup;
@endphp

<div class="row g-3">
    <div class="col-md-12">
        <label class="form-label">Dobavljač</label>
        <select name="dobavljac_id" class="form-select" required>
            <option value="">Iz liste registrovanih dobavljača</option>
            @foreach($dobavljaci as $d)
                <option value="{{ $d->id }}" @selected(old('dobavljac_id', $o->dobavljac_id ?? '') == $d->id)>
                    {{ $d->naziv }} @if($d->pib) (PIB: {{ $d->pib }}) @endif
                </option>
            @endforeach
        </select>
        @error('dobavljac_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Vrsta ploda</label>
        <input name="vrsta_ploda" class="form-control" placeholder="Borovnica / Malina / Smrčak..."
               value="{{ old('vrsta_ploda', $o->vrsta_ploda ?? '') }}" required>
        @error('vrsta_ploda') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Količina (kg)</label>
        <input id="kolicina" name="kolicina_kg" type="number" step="0.01" class="form-control"
               placeholder="npr. 25" value="{{ old('kolicina_kg', $o->kolicina_kg ?? '') }}" required>
        @error('kolicina_kg') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Cena/kg (RSD)</label>
        <input id="cena" name="cena_po_kg" type="number" step="0.01" class="form-control"
               placeholder="npr. 650" value="{{ old('cena_po_kg', $o->cena_po_kg ?? '') }}" required>
        @error('cena_po_kg') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Datum otkupa</label>
        <input name="datum_otkupa" type="date" class="form-control"
               value="{{ old('datum_otkupa', isset($o->datum_otkupa) ? \Carbon\Carbon::parse($o->datum_otkupa)->format('Y-m-d') : '') }}" required>
        @error('datum_otkupa') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Status isplate</label>
        <select name="status_isplate" class="form-select" required>
            <option value="na_cekanju" @selected(old('status_isplate', $o->status_isplate ?? 'na_cekanju') === 'na_cekanju')>Na čekanju</option>
            <option value="isplaceno" @selected(old('status_isplate', $o->status_isplate ?? '') === 'isplaceno')>Isplaćeno</option>
        </select>
        @error('status_isplate') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Ukupna vrednost</label>
        <input id="ukupno" class="form-control" placeholder="Automatski: količina × cena" readonly>
    </div>
</div>

<script>
    (function(){
        const k = document.getElementById('kolicina');
        const c = document.getElementById('cena');
        const u = document.getElementById('ukupno');

        function calc(){
            const kk = parseFloat(k?.value || 0);
            const cc = parseFloat(c?.value || 0);
            const total = (kk * cc);
            if (!u) return;
            u.value = total > 0 ? total.toLocaleString('sr-RS') + ' RSD' : '';
        }

        k?.addEventListener('input', calc);
        c?.addEventListener('input', calc);
        calc();
    })();
</script>
