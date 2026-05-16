<?php

namespace App\Http\Controllers;

use App\Models\Veto;
use Illuminate\Http\Request;

class VetoController extends Controller
{
    public function index()
    {
        $vetos = Veto::all();
        return view('vetos.index', compact('vetos'));
    }

    public function create()
    {
        return view('vetos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_vet' => 'required|string|max:255',
            'prenom_vet' => 'nullable|string|max:255',
            'tel_vet' => 'nullable|string|max:255',
        ]);
        Veto::create($validated);
        return redirect()->route('vetos.index')->with('success', 'Vétérinaire ajouté.');
    }

    public function show(Veto $veto)
    {
        $veto->load('visites.bovin');
        return view('vetos.show', compact('veto'));
    }

    public function edit(Veto $veto)
    {
        return view('vetos.edit', compact('veto'));
    }

    public function update(Request $request, Veto $veto)
    {
        $validated = $request->validate([
            'nom_vet' => 'required|string|max:255',
            'prenom_vet' => 'nullable|string|max:255',
            'tel_vet' => 'nullable|string|max:255',
        ]);
        $veto->update($validated);
        return redirect()->route('vetos.index')->with('success', 'Vétérinaire mis à jour.');
    }

    public function destroy(Veto $veto)
    {
        $veto->delete();
        return redirect()->route('vetos.index')->with('success', 'Vétérinaire supprimé.');
    }
}
