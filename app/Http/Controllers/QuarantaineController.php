<?php

namespace App\Http\Controllers;

use App\Models\Quarantaine;
use Illuminate\Http\Request;

class QuarantaineController extends Controller
{
    public function index()
    {
        $quarantaines = Quarantaine::all();
        return view('quarantaines.index', compact('quarantaines'));
    }

    public function create()
    {
        return view('quarantaines.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
        ]);
        Quarantaine::create($validated);
        return redirect()->route('quarantaines.index')->with('success', 'Quarantaine ajoutée.');
    }

    public function show(Quarantaine $quarantaine)
    {
        $quarantaine->load('bovins');
        return view('quarantaines.show', compact('quarantaine'));
    }

    public function edit(Quarantaine $quarantaine)
    {
        return view('quarantaines.edit', compact('quarantaine'));
    }

    public function update(Request $request, Quarantaine $quarantaine)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
        ]);
        $quarantaine->update($validated);
        return redirect()->route('quarantaines.index')->with('success', 'Quarantaine mise à jour.');
    }

    public function destroy(Quarantaine $quarantaine)
    {
        $quarantaine->delete();
        return redirect()->route('quarantaines.index')->with('success', 'Quarantaine supprimée.');
    }
}
