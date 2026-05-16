@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0 text-dark">Modifier Véhicule</h2>
            <a href="{{ route('vehicules.index') }}" class="btn btn-outline-secondary">Retour</a>
        </div>
        <div class="premium-card p-4">
            <form action="{{ route('vehicules.update', $vehicule->id_veh) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Matricule</label>
                        <input type="text" name="Matricule" class="form-control" required value="{{ $vehicule->Matricule }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Type</label>
                        <input type="text" name="type" class="form-control" value="{{ $vehicule->type }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Transporteur associé</label>
                        <select name="id_trans" class="form-select">
                            <option value="">-- Aucun --</option>
                            @foreach($transporteurs as $t)
                                <option value="{{ $t->id_trans }}" {{ $vehicule->id_trans == $t->id_trans ? 'selected' : '' }}>
                                    {{ $t->nom }} {{ $t->prenom }} ({{ $t->cin_t }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-premium px-4">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
