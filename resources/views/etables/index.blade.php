@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-house-chimney text-primary me-2"></i>Liste des Étables</h2>
    <a href="{{ route('etables.create') }}" class="btn btn-premium">
        <i class="fa-solid fa-plus me-1"></i> Ajouter une Étable
    </a>
</div>

<div class="premium-card p-0">
    <div class="table-responsive">
        <table class="table table-premium mb-0 table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de l'étable</th>
                    <th class="text-center">Nombre de Bovins</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($etables as $etable)
                <tr>
                    <td class="fw-bold text-muted">#{{ $etable->id_etab }}</td>
                    <td class="fw-medium">{{ $etable->nom }}</td>
                    <td class="text-center">
                        <span class="badge bg-light text-primary border rounded-pill px-3 py-2">
                            {{ $etable->bovins ? $etable->bovins->count() : 0 }} Bovins
                        </span>
                    </td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('etables.edit', $etable->id_etab) }}" class="btn btn-sm btn-outline-secondary" title="Modifier">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('etables.destroy', $etable->id_etab) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette étable ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5 text-muted">
                        <i class="fa-solid fa-house fa-3x mb-3 text-light"></i>
                        <h5>Aucune étable trouvée</h5>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
