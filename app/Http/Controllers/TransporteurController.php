<?php

namespace App\Http\Controllers;

use App\Models\Transporteur;
use Illuminate\Http\Request;

class TransporteurController extends Controller
{
    public function index()
    {
        $transporteurs = Transporteur::all();
        return view('transporteurs.index', compact('transporteurs'));
    }

    public function create()
    {
        return view('transporteurs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cin_t' => 'required|string|unique:transporteurs,cin_t|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'tel' => 'nullable|string|max:255',
        ]);
        Transporteur::create($validated);
        return redirect()->route('transporteurs.index')->with('success', 'Transporteur ajouté.');
    }

    public function show(Transporteur $transporteur)
    {
        $transporteur->load('vehicules');
        return view('transporteurs.show', compact('transporteur'));
    }

    public function edit(Transporteur $transporteur)
    {
        return view('transporteurs.edit', compact('transporteur'));
    }

    public function update(Request $request, Transporteur $transporteur)
    {
        $validated = $request->validate([
            'cin_t' => 'required|string|max:255|unique:transporteurs,cin_t,'.$transporteur->id_trans.',id_trans',
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'tel' => 'nullable|string|max:255',
        ]);
        $transporteur->update($validated);
        return redirect()->route('transporteurs.index')->with('success', 'Transporteur mis à jour.');
    }

    public function destroy(Transporteur $transporteur)
    {
        $transporteur->delete();
        return redirect()->route('transporteurs.index')->with('success', 'Transporteur supprimé.');
    }
}
