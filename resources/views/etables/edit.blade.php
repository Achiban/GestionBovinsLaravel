@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0 text-dark">Modifier l'Étable #{{ $etable->id_etab }}</h2>
            <a href="{{ route('etables.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Retour
            </a>
        </div>

        <div class="premium-card p-4">
            <form action="{{ route('etables.update', $etable->id_etab) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-medium text-muted">Nom de l'étable</label>
                    <input type="text" name="nom" class="form-control" required value="{{ $etable->nom }}">
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-premium px-4">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
