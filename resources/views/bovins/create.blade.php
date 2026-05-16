@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-plus text-primary me-2"></i>Ajouter un Bovin</h2>
            <a href="{{ route('bovins.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Retour à la liste
            </a>
        </div>

        <div class="premium-card p-4">
            <form action="{{ route('bovins.store') }}" method="POST">
                @csrf
                
                <h5 class="fw-bold mb-3 text-primary border-bottom pb-2">Informations Générales</h5>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-muted">Race du bovin</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa-solid fa-dna text-muted"></i></span>
                            <input type="text" name="race" class="form-control" placeholder="Ex: Holstein, Charolaise..." value="{{ old('race') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium text-muted">Poids Actuel (kg)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa-solid fa-weight-scale text-muted"></i></span>
                            <input type="number" step="0.01" name="poidAct" class="form-control" placeholder="0.00" value="{{ old('poidAct') }}">
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold mb-3 text-primary border-bottom pb-2">Détails d'Achat</h5>
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label class="form-label fw-medium text-muted">Date d'achat</label>
                        <input type="date" name="dateachat" class="form-control" value="{{ old('dateachat') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium text-muted">Prix d'achat (DH)</label>
                        <input type="number" step="0.01" name="prixachat" class="form-control" placeholder="0.00" value="{{ old('prixachat') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium text-muted">Poids à l'achat (kg)</label>
                        <input type="number" step="0.01" name="poidachat" class="form-control" placeholder="0.00" value="{{ old('poidachat') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-medium text-muted">Lieu d'achat</label>
                        <input type="text" name="lieuachat" class="form-control" placeholder="Souk, Ferme..." value="{{ old('lieuachat') }}">
                    </div>
                </div>

                <h5 class="fw-bold mb-3 text-primary border-bottom pb-2">Affectation</h5>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-medium text-muted">Étable</label>
                        <select name="id_etab" class="form-select">
                            <option value="">-- Sélectionner une étable --</option>
                            @foreach($etables as $etable)
                                <option value="{{ $etable->id_etab }}" {{ old('id_etab') == $etable->id_etab ? 'selected' : '' }}>{{ $etable->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-medium text-muted">Vendeur</label>
                        <select name="id_vend" class="form-select">
                            <option value="">-- Sélectionner un vendeur --</option>
                            @foreach($vendeurs as $vendeur)
                                <option value="{{ $vendeur->id_vend }}" {{ old('id_vend') == $vendeur->id_vend ? 'selected' : '' }}>{{ $vendeur->nom_vend }} {{ $vendeur->prenom_vend }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-medium text-muted">Quarantaine</label>
                        <select name="id_q" class="form-select">
                            <option value="">-- Sélectionner --</option>
                            @foreach($quarantaines as $quarantaine)
                                <option value="{{ $quarantaine->id_q }}" {{ old('id_q') == $quarantaine->id_q ? 'selected' : '' }}>{{ $quarantaine->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-5">
                    <button type="submit" class="btn btn-premium px-5 py-2">
                        <i class="fa-solid fa-save me-2"></i> Enregistrer le Bovin
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
