<?php

namespace App\Http\Controllers;

use App\Models\Otkup;
use App\Models\SerijaPrerade;
use Illuminate\Http\Request;

class SerijaPreradeController extends Controller
{
    public function index(Request $request)
    {
        $q = SerijaPrerade::query()
            ->with('otkup')
            ->orderByDesc('datum_pocetka');

        if ($request->filled('search')) {
            $s = $request->string('search')->toString();

            $q->where(function ($qq) use ($s) {
                $qq->whereHas('otkup', function ($q2) use ($s) {
                    $q2->where('vrsta_ploda', 'like', "%{$s}%");
                })
                    ->orWhere('status_kvaliteta', 'like', "%{$s}%")
                    ->orWhere('faza', 'like', "%{$s}%");
            });
        }

        if ($request->filled('faza')) {
            $q->where('faza', $request->faza);
        }

        if ($request->filled('status_kvaliteta')) {
            $q->where('status_kvaliteta', $request->status_kvaliteta);
        }

        $serije = $q->paginate(10)->withQueryString();

        $faze = SerijaPrerade::query()
            ->select('faza')->distinct()->orderBy('faza')->pluck('faza');

        $statusi = SerijaPrerade::query()
            ->select('status_kvaliteta')->distinct()->orderBy('status_kvaliteta')->pluck('status_kvaliteta');

        return view('serije.index', compact('serije', 'faze', 'statusi'));
    }

    public function create()
    {
        $otkupi = Otkup::query()->orderByDesc('datum_otkupa')->get();
        $faze = ['ciscenje', 'sušenje', 'sortiranje', 'pakovanje'];

        return view('serije.create', compact('otkupi', 'faze'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'otkup_id' => ['required', 'exists:otkups,id'],
            'faza' => ['required', 'string', 'max:255'],
            'datum_pocetka' => ['required', 'date'],
            'datum_zavrsetka' => ['nullable', 'date', 'after_or_equal:datum_pocetka'],
        ]);

        // QC polja se NE unose iz prerade – automatski idu na kontrolu
        $data['status_kvaliteta'] = 'na_kontroli';
        $data['napomena_kvaliteta'] = null;

        SerijaPrerade::create($data);

        return redirect()->route('serije.index')->with('success', 'Prerada uspešno evidentirana (status: na_kontroli).');
    }

    public function show(SerijaPrerade $serija)
    {
        $serija->load('otkup');

        return view('serije.show', compact('serija'));
    }

    public function edit(SerijaPrerade $serija)
    {
        $otkupi = Otkup::query()->orderByDesc('datum_otkupa')->get();
        $faze = ['ciscenje', 'sušenje', 'sortiranje', 'pakovanje'];

        return view('serije.edit', compact('serija', 'otkupi', 'faze'));
    }

    public function update(Request $request, SerijaPrerade $serija)
    {
        $data = $request->validate([
            'otkup_id' => ['required', 'exists:otkups,id'],
            'faza' => ['required', 'string', 'max:255'],
            'datum_pocetka' => ['required', 'date'],
            'datum_zavrsetka' => ['nullable', 'date', 'after_or_equal:datum_pocetka'],
        ]);

        // Namerno NE diramo status_kvaliteta i napomena_kvaliteta
        $serija->update($data);

        return redirect()->route('serije.index')->with('success', 'Prerada uspešno izmenjena.');
    }

    public function destroy(SerijaPrerade $serija)
    {
        $serija->delete();

        return redirect()->route('serije.index')->with('success', 'Prerada obrisana.');
    }
}
