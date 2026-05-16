@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0 text-dark">Modifier Vétérinaire</h2>
            <a href="{{ route('vetos.index') }}" class="btn btn-outline-secondary">Retour</a>
        </div>
        <div class="premium-card p-4">
            <form action="{{ route('vetos.update', $veto->id_vet) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom_vet" class="form-control" required value="{{ $veto->nom_vet }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom_vet" class="form-control" value="{{ $veto->prenom_vet }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Téléphone</label>
                        <input type="text" name="tel_vet" class="form-control" value="{{ $veto->tel_vet }}">
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
