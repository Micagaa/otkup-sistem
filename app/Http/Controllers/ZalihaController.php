<?php

namespace App\Http\Controllers;

use App\Models\SerijaPrerade;
use App\Models\Zaliha;
use Illuminate\Http\Request;

class ZalihaController extends Controller
{
    public function index(Request $request)
    {
        $q = Zaliha::query()->latest();

        if ($search = $request->get('q')) {
            $q->where(function ($sub) use ($search) {
                $sub->where('vrsta_proizvoda', 'like', "%{$search}%")
                    ->orWhere('pozicija', 'like', "%{$search}%");
            });
        }

        $zalihe = $q->paginate(10)->withQueryString();

        return view('zalihe.index', compact('zalihe', 'search'));
    }

    public function create()
    {
        $serije = \App\Models\SerijaPrerade::query()
            ->with('otkup')              // da imamo vrsta_ploda, kolicina, itd.
            ->orderByDesc('id')
            ->get();

        return view('zalihe.create', compact('serije'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'serija_prerade_id' => ['nullable', 'integer', 'exists:serija_prerades,id'],
            'vrsta_proizvoda' => ['required', 'string', 'max:255'],
            'kolicina_kg' => ['required', 'numeric', 'min:0'],
            'datum_prijema' => ['nullable', 'date'],
            'rok_upotrebe' => ['nullable', 'date'],
            'pozicija' => ['nullable', 'string', 'max:100'],
        ]);

        Zaliha::create($data);

        return redirect()->route('zalihe.index')->with('success', 'Prijem robe uspešno sačuvan.');
    }

    public function show(Zaliha $zaliha)
    {
        $zaliha->load('serijaPrerade');

        return view('zalihe.show', compact('zaliha'));
    }

    public function edit(Zaliha $zaliha)
    {
        $serije = SerijaPrerade::query()->latest()->get();

        return view('zalihe.edit', compact('zaliha', 'serije'));
    }

    public function update(Request $request, Zaliha $zaliha)
    {
        $data = $request->validate([
            'serija_prerade_id' => ['nullable', 'integer', 'exists:serija_prerades,id'],
            'vrsta_proizvoda' => ['required', 'string', 'max:255'],
            'kolicina_kg' => ['required', 'numeric', 'min:0'],
            'datum_prijema' => ['nullable', 'date'],
            'rok_upotrebe' => ['nullable', 'date'],
            'pozicija' => ['nullable', 'string', 'max:100'],
        ]);

        $zaliha->update($data);

        return redirect()->route('zalihe.index')->with('success', 'Zaliha uspešno izmenjena.');
    }

    public function destroy(Zaliha $zaliha)
    {
        $zaliha->delete();

        return redirect()->route('zalihe.index')->with('success', 'Zaliha obrisana.');
    }
}
