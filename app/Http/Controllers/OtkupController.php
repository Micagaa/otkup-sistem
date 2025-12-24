<?php

namespace App\Http\Controllers;

use App\Models\Dobavljac;
use App\Models\Otkup;
use Illuminate\Http\Request;

class OtkupController extends Controller
{
    public function index(Request $request)
    {
        $q = Otkup::query()->with('dobavljac')->orderByDesc('datum_otkupa');

        // Filteri (kao na figmi)
        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $q->whereHas('dobavljac', function ($qq) use ($search) {
                $qq->where('naziv', 'like', "%{$search}%")
                    ->orWhere('pib', 'like', "%{$search}%");
            });
        }

        if ($request->filled('vrsta_ploda')) {
            $q->where('vrsta_ploda', $request->vrsta_ploda);
        }

        if ($request->filled('from')) {
            $q->whereDate('datum_otkupa', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $q->whereDate('datum_otkupa', '<=', $request->to);
        }

        $otkupi = $q->paginate(10)->withQueryString();

        // dropdown za vrste ploda (distinct iz baze)
        $vrstePloda = Otkup::query()->select('vrsta_ploda')->distinct()->orderBy('vrsta_ploda')->pluck('vrsta_ploda');

        return view('otkupi.index', compact('otkupi', 'vrstePloda'));
    }

    public function create()
    {
        $dobavljaci = Dobavljac::orderBy('naziv')->get();

        return view('otkupi.create', compact('dobavljaci'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'dobavljac_id' => ['required', 'exists:dobavljacs,id'],
            'vrsta_ploda' => ['required', 'string', 'max:255'],
            'kolicina_kg' => ['required', 'numeric', 'min:0.01'],
            'cena_po_kg' => ['required', 'numeric', 'min:0.01'],
            'datum_otkupa' => ['required', 'date'],
            'status_isplate' => ['required', 'in:na_cekanju,isplaceno'],
        ]);

        Otkup::create($data);

        return redirect()->route('otkupi.index')->with('success', 'Otkup uspešno evidentiran.');
    }

    public function show(Otkup $otkup)
    {
        $otkup->load('dobavljac');

        $vrednost = (float) $otkup->kolicina_kg * (float) $otkup->cena_po_kg;

        return view('otkupi.show', compact('otkup', 'vrednost'));
    }

    public function edit(Otkup $otkup)
    {
        $dobavljaci = Dobavljac::orderBy('naziv')->get();

        return view('otkupi.edit', compact('otkup', 'dobavljaci'));
    }

    public function update(Request $request, Otkup $otkup)
    {
        $data = $request->validate([
            'dobavljac_id' => ['required', 'exists:dobavljacs,id'],
            'vrsta_ploda' => ['required', 'string', 'max:255'],
            'kolicina_kg' => ['required', 'numeric', 'min:0.01'],
            'cena_po_kg' => ['required', 'numeric', 'min:0.01'],
            'datum_otkupa' => ['required', 'date'],
            'status_isplate' => ['required', 'in:na_cekanju,isplaceno'],
        ]);

        $otkup->update($data);

        return redirect()->route('otkupi.index')->with('success', 'Otkup uspešno izmenjen.');
    }

    public function destroy(Otkup $otkup)
    {
        $otkup->delete();

        return redirect()->route('otkupi.index')->with('success', 'Otkup obrisan.');
    }
}
