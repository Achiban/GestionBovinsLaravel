<?php

namespace App\Http\Controllers;

use App\Models\Etable;
use Illuminate\Http\Request;

class EtableController extends Controller
{
    public function index()
    {
        $etables = Etable::all();
        return view('etables.index', compact('etables'));
    }

    public function create()
    {
        return view('etables.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);
        Etable::create($validated);
        return redirect()->route('etables.index')->with('success', 'Étable ajoutée.');
    }

    public function show(Etable $etable)
    {
        $etable->load('bovins');
        return view('etables.show', compact('etable'));
    }

    public function edit(Etable $etable)
    {
        return view('etables.edit', compact('etable'));
    }

    public function update(Request $request, Etable $etable)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);
        $etable->update($validated);
        return redirect()->route('etables.index')->with('success', 'Étable mise à jour.');
    }

    public function destroy(Etable $etable)
    {
        $etable->delete();
        return redirect()->route('etables.index')->with('success', 'Étable supprimée.');
    }
}
