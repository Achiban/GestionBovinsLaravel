@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0 text-dark">Modifier Visite #{{ $visite->id_pres }}</h2>
            <a href="{{ route('visites.index') }}" class="btn btn-outline-secondary">Retour</a>
        </div>
        <div class="premium-card p-4">
            <form action="{{ route('visites.update', $visite->id_pres) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Date de la visite</label>
                        <input type="date" name="datepres" class="form-control" value="{{ $visite->datepres ? $visite->datepres->format('Y-m-d') : '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Frais (DH)</label>
                        <input type="number" step="0.01" name="prix_pres" class="form-control" min="0" value="{{ $visite->prix_pres }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Bovin (Patient)</label>
                        <select name="id_bov" class="form-select" required>
                            <option value="">-- Sélectionner un bovin --</option>
                            @foreach($bovins as $bovin)
                                <option value="{{ $bovin->id_bov }}" {{ $visite->id_bov == $bovin->id_bov ? 'selected' : '' }}>
                                    Bovin #{{ $bovin->id_bov }} {{ $bovin->race ? '('.$bovin->race.')' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Vétérinaire</label>
                        <select name="id_vet" class="form-select">
                            <option value="">-- Sélectionner --</option>
                            @foreach($vetos as $veto)
                                <option value="{{ $veto->id_vet }}" {{ $visite->id_vet == $veto->id_vet ? 'selected' : '' }}>
                                    Dr. {{ $veto->nom_vet }} {{ $veto->prenom_vet }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Description / Diagnostic</label>
                        <textarea name="description_v" class="form-control" rows="4">{{ $visite->description_v }}</textarea>
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
