<?php

namespace App\Http\Controllers;

use App\Models\SerijaPrerade;
use Illuminate\Http\Request;

class KontrolaKvalitetaController extends Controller
{
    public function index(Request $request)
    {
        $q = SerijaPrerade::query()
            ->with('otkup')
            ->orderByDesc('datum_pocetka');

        // default: prikazi prvo "na_kontroli"
        if (! $request->filled('status')) {
            $q->where('status_kvaliteta', 'na_kontroli');
        } else {
            $q->where('status_kvaliteta', $request->status);
        }

        if ($request->filled('search')) {
            $s = $request->string('search')->toString();
            $q->where(function ($qq) use ($s) {
                $qq->where('id', $s)
                    ->orWhereHas('otkup', fn ($q2) => $q2->where('vrsta_ploda', 'like', "%{$s}%"))
                    ->orWhere('faza', 'like', "%{$s}%");
            });
        }

        $serije = $q->paginate(10)->withQueryString();
        $statusi = ['na_kontroli', 'ispravno', 'neispravno'];

        return view('qc.index', compact('serije', 'statusi'));
    }

    public function edit(SerijaPrerade $serija)
    {
        $serija->load('otkup');

        return view('qc.edit', compact('serija'));
    }

    public function update(Request $request, SerijaPrerade $serija)
    {
        $data = $request->validate([
            'status_kvaliteta' => ['required', 'in:ispravno,neispravno'],
            'napomena_kvaliteta' => ['nullable', 'string', 'max:2000'],
        ]);

        $serija->update($data);

        return redirect()->route('qc.index')->with('success', 'Kontrola kvaliteta sačuvana.');
    }
}
