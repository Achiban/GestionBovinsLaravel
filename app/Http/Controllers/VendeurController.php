<?php

namespace App\Http\Controllers;

use App\Models\Vendeur;
use Illuminate\Http\Request;

class VendeurController extends Controller
{
    public function index()
    {
        $vendeurs = Vendeur::all();
        return view('vendeurs.index', compact('vendeurs'));
    }

    public function create()
    {
        return view('vendeurs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_vend' => 'required|string|max:255',
            'prenom_vend' => 'nullable|string|max:255',
            'tel_vend' => 'nullable|string|max:255',
            'farm_vend' => 'nullable|string|max:255',
        ]);
        Vendeur::create($validated);
        return redirect()->route('vendeurs.index')->with('success', 'Vendeur ajouté.');
    }

    public function show(Vendeur $vendeur)
    {
        $vendeur->load('bovins');
        return view('vendeurs.show', compact('vendeur'));
    }

    public function edit(Vendeur $vendeur)
    {
        return view('vendeurs.edit', compact('vendeur'));
    }

    public function update(Request $request, Vendeur $vendeur)
    {
        $validated = $request->validate([
            'nom_vend' => 'required|string|max:255',
            'prenom_vend' => 'nullable|string|max:255',
            'tel_vend' => 'nullable|string|max:255',
            'farm_vend' => 'nullable|string|max:255',
        ]);
        $vendeur->update($validated);
        return redirect()->route('vendeurs.index')->with('success', 'Vendeur mis à jour.');
    }

    public function destroy(Vendeur $vendeur)
    {
        $vendeur->delete();
        return redirect()->route('vendeurs.index')->with('success', 'Vendeur supprimé.');
    }
}
