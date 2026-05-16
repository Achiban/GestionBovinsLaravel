<?php

namespace App\Http\Controllers;

use App\Models\Visite;
use App\Models\Bovin;
use App\Models\Veto;
use Illuminate\Http\Request;

class VisiteController extends Controller
{
    public function index()
    {
        $visites = Visite::with(['bovin', 'veto'])->get();
        return view('visites.index', compact('visites'));
    }

    public function create()
    {
        $bovins = Bovin::all();
        $vetos = Veto::all();
        return view('visites.create', compact('bovins', 'vetos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description_v' => 'nullable|string',
            'datepres' => 'nullable|date',
            'prix_pres' => 'nullable|numeric|min:0',
            'id_bov' => 'required|exists:bovins,id_bov',
            'id_vet' => 'nullable|exists:vetos,id_vet',
        ]);
        Visite::create($validated);
        return redirect()->route('visites.index')->with('success', 'Visite ajoutée.');
    }

    public function show(Visite $visite)
    {
        $visite->load(['bovin', 'veto']);
        return view('visites.show', compact('visite'));
    }

    public function edit(Visite $visite)
    {
        $bovins = Bovin::all();
        $vetos = Veto::all();
        return view('visites.edit', compact('visite', 'bovins', 'vetos'));
    }

    public function update(Request $request, Visite $visite)
    {
        $validated = $request->validate([
            'description_v' => 'nullable|string',
            'datepres' => 'nullable|date',
            'prix_pres' => 'nullable|numeric|min:0',
            'id_bov' => 'required|exists:bovins,id_bov',
            'id_vet' => 'nullable|exists:vetos,id_vet',
        ]);
        $visite->update($validated);
        return redirect()->route('visites.index')->with('success', 'Visite mise à jour.');
    }

    public function destroy(Visite $visite)
    {
        $visite->delete();
        return redirect()->route('visites.index')->with('success', 'Visite supprimée.');
    }
}
