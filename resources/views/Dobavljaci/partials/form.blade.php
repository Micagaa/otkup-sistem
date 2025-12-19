@php
    $d = $dobavljac;
@endphp

<div class="mb-3">
    <label class="form-label">Naziv *</label>
    <input class="form-control" name="naziv" value="{{ old('naziv', $d->naziv ?? '') }}" required>
    @error('naziv') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
</div>

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">PIB</label>
        <input class="form-control" name="pib" value="{{ old('pib', $d->pib ?? '') }}">
        @error('pib') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Mesto</label>
        <input class="form-control" name="mesto" value="{{ old('mesto', $d->mesto ?? '') }}">
        @error('mesto') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row g-3 mt-0">
    <div class="col-md-6">
        <label class="form-label">Telefon</label>
        <input class="form-control" name="telefon" value="{{ old('telefon', $d->telefon ?? '') }}">
        @error('telefon') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input class="form-control" name="email" type="email" value="{{ old('email', $d->email ?? '') }}">
        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
</div>
