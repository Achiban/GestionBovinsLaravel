<?php

namespace App\Http\Controllers;

use App\Models\MedicConsomme;
use Illuminate\Http\Request;

class MedicConsommeController extends Controller
{
    public function index()
    {
        $consommations = MedicConsomme::with('bovin')->get();
        return view('medic_consommes.index', compact('consommations'));
    }

    public function show(MedicConsomme $medicConsomme)
    {
        $medicConsomme->load('bovin');
        return view('medic_consommes.show', compact('medicConsomme'));
    }

    public function destroy(MedicConsomme $medicConsomme)
    {
        $medicConsomme->delete();
        return redirect()->route('medic_consommes.index')->with('success', 'Enregistrement supprimé.');
    }
}
