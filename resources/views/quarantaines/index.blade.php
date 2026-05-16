@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-shield-virus text-primary me-2"></i>Zones de Quarantaine</h2>
    <a href="{{ route('quarantaines.create') }}" class="btn btn-premium">
        <i class="fa-solid fa-plus me-1"></i> Ajouter Zone
    </a>
</div>

<div class="premium-card p-0">
    <div class="table-responsive">
        <table class="table table-premium mb-0 table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libellé / Nom de la zone</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($quarantaines as $q)
                <tr>
                    <td class="fw-bold text-muted">#{{ $q->id_q }}</td>
                    <td class="fw-medium">{{ $q->libelle }}</td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('quarantaines.edit', $q->id_q) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('quarantaines.destroy', $q->id_q) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette zone ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center py-4">Aucune zone de quarantaine.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
