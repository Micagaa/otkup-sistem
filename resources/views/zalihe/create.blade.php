@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center gap-2">
            <span style="font-size:20px;">🌲</span>
            <h5 class="mb-0">Smrčak DOO Ivanjica</h5>
        </div>
    </div>

    <div class="text-center mb-4">
        <h2 class="mb-1">Forma za prijem robe u hladnjaču</h2>
        <div class="text-muted small">Unesite podatke i sačuvajte prijem</div>
    </div>

    <div class="card shadow-sm mx-auto" style="max-width: 820px; border-radius:16px;">
        <div class="card-body p-4">

            <form method="POST" action="{{ route('zalihe.store') }}">
                @csrf

                @include('zalihe.partials.form', ['zaliha' => null, 'serije' => $serije])

                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button class="btn btn-success px-4">Sačuvaj prijem</button>
                    <a href="{{ route('zalihe.index') }}" class="btn btn-outline-secondary px-4">Otkaži</a>
                </div>
            </form>

        </div>
    </div>

</div>

{{-- AUTO POPUNA: kad izabereš seriju, popuni vrstu proizvoda i količinu --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const sel = document.getElementById('serija_prerade_id');
    const vrsta = document.getElementById('vrsta_proizvoda');
    const kolicina = document.getElementById('kolicina_kg');

    if (!sel) return;

    function applySelected(overwrite = false) {
        const opt = sel.options[sel.selectedIndex];
        if (!opt || !opt.value) return;

        const v = opt.dataset.vrsta || '';
        const k = opt.dataset.kolicina || '';

        if (vrsta && (overwrite || !vrsta.value)) vrsta.value = v;
        if (kolicina && (overwrite || !kolicina.value)) kolicina.value = k;
    }

    sel.addEventListener('change', () => applySelected(true));

    // ako je već selektovano (npr. posle validacije), popuni
    applySelected(false);
});
</script>
@endsection
