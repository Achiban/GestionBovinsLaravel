<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\Transporteur;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    public function index()
    {
        $vehicules = Vehicule::with('transporteur')->get();
        return view('vehicules.index', compact('vehicules'));
    }

    public function create()
    {
        $transporteurs = Transporteur::all();
        return view('vehicules.create', compact('transporteurs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Matricule' => 'required|string|unique:vehicules,Matricule|max:255',
            'type' => 'nullable|string|max:255',
            'id_trans' => 'nullable|exists:transporteurs,id_trans',
        ]);
        Vehicule::create($validated);
        return redirect()->route('vehicules.index')->with('success', 'Véhicule ajouté.');
    }

    public function show(Vehicule $vehicule)
    {
        $vehicule->load('transporteur');
        return view('vehicules.show', compact('vehicule'));
    }

    public function edit(Vehicule $vehicule)
    {
        $transporteurs = Transporteur::all();
        return view('vehicules.edit', compact('vehicule', 'transporteurs'));
    }

    public function update(Request $request, Vehicule $vehicule)
    {
        $validated = $request->validate([
            'Matricule' => 'required|string|max:255|unique:vehicules,Matricule,'.$vehicule->id_veh.',id_veh',
            'type' => 'nullable|string|max:255',
            'id_trans' => 'nullable|exists:transporteurs,id_trans',
        ]);
        $vehicule->update($validated);
        return redirect()->route('vehicules.index')->with('success', 'Véhicule mis à jour.');
    }

    public function destroy(Vehicule $vehicule)
    {
        $vehicule->delete();
        return redirect()->route('vehicules.index')->with('success', 'Véhicule supprimé.');
    }
}
