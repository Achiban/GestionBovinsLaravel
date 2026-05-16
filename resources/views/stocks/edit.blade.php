@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0 text-dark">Modifier Stock Alimentaire</h2>
            <a href="{{ route('stocks.index') }}" class="btn btn-outline-secondary">Retour</a>
        </div>
        <div class="premium-card p-4">
            <form action="{{ route('stocks.update', $stock->id_stock) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Libellé</label>
                        <input type="text" name="libelle_st" class="form-control" required value="{{ $stock->libelle_st }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description_s" class="form-control" rows="3">{{ $stock->description_s }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Quantité Achetée (kg)</label>
                        <input type="number" name="quantite_s" class="form-control" required min="0" value="{{ $stock->quantite_s }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Quantité Actuelle (kg)</label>
                        <input type="number" name="quantiteAct" class="form-control" required min="0" value="{{ $stock->quantiteAct }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Prix Total (DH)</label>
                        <input type="number" step="0.01" name="prix_s" class="form-control" min="0" value="{{ $stock->prix_s }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date d'achat</label>
                        <input type="date" name="dateachat" class="form-control" value="{{ $stock->dateachat ? $stock->dateachat->format('Y-m-d') : '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-danger">Date d'expiration</label>
                        <input type="date" name="dateexp_s" class="form-control" value="{{ $stock->dateexp_s ? $stock->dateexp_s->format('Y-m-d') : '' }}">
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
