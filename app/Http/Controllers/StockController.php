<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        return view('stocks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle_st' => 'required|string|max:255',
            'description_s' => 'nullable|string',
            'quantite_s' => 'required|integer|min:0',
            'quantiteAct' => 'required|integer|min:0',
            'prix_s' => 'nullable|numeric|min:0',
            'dateachat' => 'nullable|date',
            'dateexp_s' => 'nullable|date',
        ]);
        Stock::create($validated);
        return redirect()->route('stocks.index')->with('success', 'Stock ajouté.');
    }

    public function show(Stock $stock)
    {
        return view('stocks.show', compact('stock'));
    }

    public function edit(Stock $stock)
    {
        return view('stocks.edit', compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $validated = $request->validate([
            'libelle_st' => 'required|string|max:255',
            'description_s' => 'nullable|string',
            'quantite_s' => 'required|integer|min:0',
            'quantiteAct' => 'required|integer|min:0',
            'prix_s' => 'nullable|numeric|min:0',
            'dateachat' => 'nullable|date',
            'dateexp_s' => 'nullable|date',
        ]);
        $stock->update($validated);
        return redirect()->route('stocks.index')->with('success', 'Stock mis à jour.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stocks.index')->with('success', 'Stock supprimé.');
    }
}
