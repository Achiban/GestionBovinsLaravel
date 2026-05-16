@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0 text-dark">Ajouter Véhicule</h2>
            <a href="{{ route('vehicules.index') }}" class="btn btn-outline-secondary">Retour</a>
        </div>
        <div class="premium-card p-4">
            <form action="{{ route('vehicules.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Matricule</label>
                        <input type="text" name="Matricule" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Type (Camion, Camionnette...)</label>
                        <input type="text" name="type" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Transporteur associé</label>
                        <select name="id_trans" class="form-select">
                            <option value="">-- Aucun --</option>
                            @foreach($transporteurs as $t)
                                <option value="{{ $t->id_trans }}">{{ $t->nom }} {{ $t->prenom }} ({{ $t->cin_t }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-premium px-4">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
