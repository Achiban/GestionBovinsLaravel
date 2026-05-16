@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0 text-dark">Modifier Médicament</h2>
            <a href="{{ route('medicaments.index') }}" class="btn btn-outline-secondary">Retour</a>
        </div>
        <div class="premium-card p-4">
            <form action="{{ route('medicaments.update', $medicament->id_med) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Libellé du médicament</label>
                        <input type="text" name="libelle" class="form-control" required value="{{ $medicament->libelle }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ $medicament->description }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Quantité</label>
                        <input type="number" name="quantite_med" class="form-control" required min="0" value="{{ $medicament->quantite_med }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Prix unitaire (DH)</label>
                        <input type="number" step="0.01" name="prix_med" class="form-control" min="0" value="{{ $medicament->prix_med }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Date d'achat</label>
                        <input type="date" name="dateachat" class="form-control" value="{{ $medicament->dateachat ? $medicament->dateachat->format('Y-m-d') : '' }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-danger fw-medium">Date d'expiration</label>
                        <input type="date" name="dateexp_med" class="form-control" value="{{ $medicament->dateexp_med ? $medicament->dateexp_med->format('Y-m-d') : '' }}">
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
