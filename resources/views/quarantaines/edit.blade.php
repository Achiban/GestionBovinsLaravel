@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0 text-dark">Modifier Zone de Quarantaine</h2>
            <a href="{{ route('quarantaines.index') }}" class="btn btn-outline-secondary">Retour</a>
        </div>
        <div class="premium-card p-4">
            <form action="{{ route('quarantaines.update', $quarantaine->id_q) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Libellé / Nom de la zone</label>
                    <input type="text" name="libelle" class="form-control" required value="{{ $quarantaine->libelle }}">
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-premium px-4">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
