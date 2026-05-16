<?php

namespace App\Http\Controllers;

use App\Models\Bovin;
use App\Models\Etable;
use App\Models\Vendeur;
use App\Models\Quarantaine;
use App\Models\Medicament;
use App\Models\Stock;
use App\Models\MedicConsomme;
use App\Models\Nourriture;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BovinController extends Controller
{
    public function index()
    {
        $bovins = Bovin::with(['etable', 'vendeur', 'quarantaine'])->get();
        return view('bovins.index', compact('bovins'));
    }

    public function create()
    {
        $etables = Etable::all();
        $vendeurs = Vendeur::all();
        $quarantaines = Quarantaine::all();
        return view('bovins.create', compact('etables', 'vendeurs', 'quarantaines'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'race' => 'nullable|string|max:255',
            'dateachat' => 'nullable|date',
            'prixachat' => 'nullable|numeric',
            'poidachat' => 'nullable|numeric',
            'lieuachat' => 'nullable|string|max:255',
            'id_etab' => 'nullable|exists:etables,id_etab',
            'id_vend' => 'nullable|exists:vendeurs,id_vend',
            'id_q' => 'nullable|exists:quarantaines,id_q',
            'poidAct' => 'nullable|numeric'
        ]);

        Bovin::create($validated);

        return redirect()->route('bovins.index')->with('success', 'Bovin ajouté avec succès.');
    }

    public function show(Bovin $bovin)
    {
        $bovin->load(['etable', 'vendeur', 'quarantaine', 'medicConsommes', 'nourritures', 'visites.veto']);
        return view('bovins.show', compact('bovin'));
    }

    public function edit(Bovin $bovin)
    {
        $etables = Etable::all();
        $vendeurs = Vendeur::all();
        $quarantaines = Quarantaine::all();
        return view('bovins.edit', compact('bovin', 'etables', 'vendeurs', 'quarantaines'));
    }

    public function update(Request $request, Bovin $bovin)
    {
        $validated = $request->validate([
            'race' => 'nullable|string|max:255',
            'dateachat' => 'nullable|date',
            'prixachat' => 'nullable|numeric',
            'poidachat' => 'nullable|numeric',
            'lieuachat' => 'nullable|string|max:255',
            'id_etab' => 'nullable|exists:etables,id_etab',
            'id_vend' => 'nullable|exists:vendeurs,id_vend',
            'id_q' => 'nullable|exists:quarantaines,id_q',
            'poidAct' => 'nullable|numeric'
        ]);

        $bovin->update($validated);

        return redirect()->route('bovins.index')->with('success', 'Bovin mis à jour avec succès.');
    }

    public function destroy(Bovin $bovin)
    {
        $bovin->delete();
        return redirect()->route('bovins.index')->with('success', 'Bovin supprimé avec succès.');
    }

    // Actions métier spécifiques

    public function vendre(Request $request, Bovin $bovin)
    {
        $request->validate([
            'datevente' => 'required|date',
            'prixavente' => 'required|numeric',
            'poidvente' => 'required|numeric',
            'lieuvente' => 'required|string|max:255',
        ]);

        $bovin->update([
            'vendu' => true,
            'datevente' => $request->datevente,
            'prixavente' => $request->prixavente,
            'poidvente' => $request->poidvente,
            'lieuvente' => $request->lieuvente,
        ]);

        return back()->with('success', 'Bovin marqué comme vendu.');
    }

    public function marquerMort(Request $request, Bovin $bovin)
    {
        $request->validate([
            'datemort' => 'required|date',
        ]);

        $bovin->update([
            'mort' => true,
            'datemort' => $request->datemort,
        ]);

        return back()->with('success', 'Bovin déclaré mort.');
    }

    public function donnerMedicament(Request $request, Bovin $bovin)
    {
        $request->validate([
            'id_med' => 'required|exists:medicaments,id_med',
            'quantite_m' => 'required|integer|min:1',
        ]);

        $medicament = Medicament::findOrFail($request->id_med);

        if ($medicament->quantite_med < $request->quantite_m) {
            return back()->with('error', 'Stock de médicament insuffisant.');
        }

        // Décrémenter le stock
        $medicament->decrement('quantite_med', $request->quantite_m);

        // Ajouter la consommation
        MedicConsomme::create([
            'libelle_m' => $medicament->libelle,
            'quantite_m' => $request->quantite_m,
            'id_bov' => $bovin->id_bov,
        ]);

        return back()->with('success', 'Médicament administré et stock mis à jour.');
    }

    public function donnerAlimentation(Request $request, Bovin $bovin)
    {
        $request->validate([
            'id_stock' => 'required|exists:stocks,id_stock',
            'quantite_n' => 'required|integer|min:1',
        ]);

        $stock = Stock::findOrFail($request->id_stock);

        if ($stock->quantiteAct < $request->quantite_n) {
            return back()->with('error', 'Stock de nourriture insuffisant.');
        }

        // Décrémenter le stock
        $stock->decrement('quantiteAct', $request->quantite_n);

        // Ajouter la consommation de nourriture
        Nourriture::create([
            'libelle_n' => $stock->libelle_st,
            'quantite_n' => $request->quantite_n,
            'prix' => $stock->prix_s,
            'id_bov' => $bovin->id_bov,
        ]);

        return back()->with('success', 'Alimentation donnée et stock mis à jour.');
    }
}
