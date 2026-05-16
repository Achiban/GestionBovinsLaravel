@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-user-tie text-primary me-2"></i>Liste des Vendeurs</h2>
    <a href="{{ route('vendeurs.create') }}" class="btn btn-premium">
        <i class="fa-solid fa-plus me-1"></i> Ajouter un Vendeur
    </a>
</div>

<div class="premium-card p-0">
    <div class="table-responsive">
        <table class="table table-premium mb-0 table-hover">
            <thead>
                <tr>
                    <th>Nom & Prénom</th>
                    <th>Téléphone</th>
                    <th>Ferme / Entreprise</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vendeurs as $vendeur)
                <tr>
                    <td class="fw-medium">{{ $vendeur->nom_vend }} {{ $vendeur->prenom_vend }}</td>
                    <td>{{ $vendeur->tel_vend ?? '-' }}</td>
                    <td>{{ $vendeur->farm_vend ?? '-' }}</td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('vendeurs.edit', $vendeur->id_vend) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('vendeurs.destroy', $vendeur->id_vend) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce vendeur ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-4">Aucun vendeur.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
