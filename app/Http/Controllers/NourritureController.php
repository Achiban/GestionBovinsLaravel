<?php

namespace App\Http\Controllers;

use App\Models\Nourriture;
use Illuminate\Http\Request;

class NourritureController extends Controller
{
    public function index()
    {
        $nourritures = Nourriture::with('bovin')->get();
        return view('nourritures.index', compact('nourritures'));
    }

    public function show(Nourriture $nourriture)
    {
        $nourriture->load('bovin');
        return view('nourritures.show', compact('nourriture'));
    }

    public function destroy(Nourriture $nourriture)
    {
        $nourriture->delete();
        return redirect()->route('nourritures.index')->with('success', 'Enregistrement supprimé.');
    }
}
