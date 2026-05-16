@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-car text-primary me-2"></i>Liste des Véhicules</h2>
    <a href="{{ route('vehicules.create') }}" class="btn btn-premium">
        <i class="fa-solid fa-plus me-1"></i> Ajouter Véhicule
    </a>
</div>

<div class="premium-card p-0">
    <div class="table-responsive">
        <table class="table table-premium mb-0 table-hover">
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Type</th>
                    <th>Transporteur (Propriétaire)</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vehicules as $vehicule)
                <tr>
                    <td class="fw-bold">{{ $vehicule->Matricule }}</td>
                    <td>{{ $vehicule->type ?? '-' }}</td>
                    <td>
                        @if($vehicule->transporteur)
                            {{ $vehicule->transporteur->nom }} {{ $vehicule->transporteur->prenom }}
                        @else
                            <span class="text-muted">Aucun</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('vehicules.edit', $vehicule->id_veh) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('vehicules.destroy', $vehicule->id_veh) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce véhicule ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-4">Aucun véhicule.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
