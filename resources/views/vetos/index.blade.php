@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-user-doctor text-primary me-2"></i>Liste des Vétérinaires</h2>
    <a href="{{ route('vetos.create') }}" class="btn btn-premium">
        <i class="fa-solid fa-plus me-1"></i> Ajouter Vétérinaire
    </a>
</div>

<div class="premium-card p-0">
    <div class="table-responsive">
        <table class="table table-premium mb-0 table-hover">
            <thead>
                <tr>
                    <th>Nom & Prénom</th>
                    <th>Téléphone</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vetos as $veto)
                <tr>
                    <td class="fw-medium">Dr. {{ $veto->nom_vet }} {{ $veto->prenom_vet }}</td>
                    <td>{{ $veto->tel_vet ?? '-' }}</td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('vetos.edit', $veto->id_vet) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('vetos.destroy', $veto->id_vet) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce vétérinaire ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center py-4">Aucun vétérinaire.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
