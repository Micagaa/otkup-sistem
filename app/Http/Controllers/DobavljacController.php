<?php

namespace App\Http\Controllers;

use App\Models\Dobavljac;
use Illuminate\Http\Request;

class DobavljacController extends Controller
{
    public function index()
    {
        $dobavljaci = Dobavljac::orderBy('naziv')->paginate(10);
        return view('dobavljaci.index', compact('dobavljaci'));
    }

    public function create()
    {
        return view('dobavljaci.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'naziv'   => ['required', 'string', 'max:255'],
            'pib'     => ['nullable', 'string', 'max:50'],
            'mesto'   => ['nullable', 'string', 'max:255'],
            'telefon' => ['nullable', 'string', 'max:50'],
            'email'   => ['nullable', 'email', 'max:255'],
        ]);

        Dobavljac::create($data);

        return redirect()
            ->route('dobavljaci.index')
            ->with('success', 'Dobavljač je uspešno dodat.');
    }

    public function show(Dobavljac $dobavljac)
    {
        return view('dobavljaci.show', compact('dobavljac'));
    }

    public function edit(Dobavljac $dobavljac)
    {
        return view('dobavljaci.edit', compact('dobavljac'));
    }

    public function update(Request $request, Dobavljac $dobavljac)
    {
        $data = $request->validate([
            'naziv'   => ['required', 'string', 'max:255'],
            'pib'     => ['nullable', 'string', 'max:50'],
            'mesto'   => ['nullable', 'string', 'max:255'],
            'telefon' => ['nullable', 'string', 'max:50'],
            'email'   => ['nullable', 'email', 'max:255'],
        ]);

        $dobavljac->update($data);

        return redirect()
            ->route('dobavljaci.index')
            ->with('success', 'Dobavljač je uspešno izmenjen.');
    }

    public function destroy(Dobavljac $dobavljac)
    {
        $dobavljac->delete();

        return redirect()
            ->route('dobavljaci.index')
            ->with('success', 'Dobavljač je obrisan.');
    }
}
