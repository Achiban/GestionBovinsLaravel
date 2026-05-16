<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use Illuminate\Http\Request;

class MedicamentController extends Controller
{
    public function index()
    {
        $medicaments = Medicament::all();
        return view('medicaments.index', compact('medicaments'));
    }

    public function create()
    {
        return view('medicaments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantite_med' => 'required|integer|min:0',
            'prix_med' => 'nullable|numeric|min:0',
            'dateachat' => 'nullable|date',
            'dateexp_med' => 'nullable|date',
        ]);
        Medicament::create($validated);
        return redirect()->route('medicaments.index')->with('success', 'Médicament ajouté.');
    }

    public function show(Medicament $medicament)
    {
        return view('medicaments.show', compact('medicament'));
    }

    public function edit(Medicament $medicament)
    {
        return view('medicaments.edit', compact('medicament'));
    }

    public function update(Request $request, Medicament $medicament)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantite_med' => 'required|integer|min:0',
            'prix_med' => 'nullable|numeric|min:0',
            'dateachat' => 'nullable|date',
            'dateexp_med' => 'nullable|date',
        ]);
        $medicament->update($validated);
        return redirect()->route('medicaments.index')->with('success', 'Médicament mis à jour.');
    }

    public function destroy(Medicament $medicament)
    {
        $medicament->delete();
        return redirect()->route('medicaments.index')->with('success', 'Médicament supprimé.');
    }
}
