@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0 text-dark">Ajouter Stock Alimentaire</h2>
            <a href="{{ route('stocks.index') }}" class="btn btn-outline-secondary">Retour</a>
        </div>
        <div class="premium-card p-4">
            <form action="{{ route('stocks.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Libellé (Nom de l'aliment)</label>
                        <input type="text" name="libelle_st" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description_s" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Quantité Achetée (kg)</label>
                        <input type="number" name="quantite_s" class="form-control" required min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Quantité Actuelle (kg)</label>
                        <input type="number" name="quantiteAct" class="form-control" required min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Prix Total (DH)</label>
                        <input type="number" step="0.01" name="prix_s" class="form-control" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date d'achat</label>
                        <input type="date" name="dateachat" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-danger">Date d'expiration</label>
                        <input type="date" name="dateexp_s" class="form-control">
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
