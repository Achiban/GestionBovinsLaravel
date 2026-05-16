@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-truck text-primary me-2"></i>Liste des Transporteurs</h2>
    <a href="{{ route('transporteurs.create') }}" class="btn btn-premium">
        <i class="fa-solid fa-plus me-1"></i> Ajouter Transporteur
    </a>
</div>

<div class="premium-card p-0">
    <div class="table-responsive">
        <table class="table table-premium mb-0 table-hover">
            <thead>
                <tr>
                    <th>CIN</th>
                    <th>Nom & Prénom</th>
                    <th>Téléphone</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transporteurs as $transporteur)
                <tr>
                    <td class="fw-bold">{{ $transporteur->cin_t }}</td>
                    <td class="fw-medium">{{ $transporteur->nom }} {{ $transporteur->prenom }}</td>
                    <td>{{ $transporteur->tel ?? '-' }}</td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('transporteurs.edit', $transporteur->id_trans) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('transporteurs.destroy', $transporteur->id_trans) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce transporteur ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-4">Aucun transporteur.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
