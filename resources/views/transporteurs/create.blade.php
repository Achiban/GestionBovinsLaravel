@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0 text-dark">Ajouter Transporteur</h2>
            <a href="{{ route('transporteurs.index') }}" class="btn btn-outline-secondary">Retour</a>
        </div>
        <div class="premium-card p-4">
            <form action="{{ route('transporteurs.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">CIN / Numéro d'identité</label>
                        <input type="text" name="cin_t" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="tel" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control">
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
