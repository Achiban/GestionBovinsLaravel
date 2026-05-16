@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-pills text-primary me-2"></i>Stock Médicaments</h2>
    <a href="{{ route('medicaments.create') }}" class="btn btn-premium">
        <i class="fa-solid fa-plus me-1"></i> Nouveau Médicament
    </a>
</div>

<div class="premium-card p-0">
    <div class="table-responsive">
        <table class="table table-premium mb-0 table-hover">
            <thead>
                <tr>
                    <th>Libellé</th>
                    <th>Quantité (Unités)</th>
                    <th>Prix</th>
                    <th>Date d'expiration</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($medicaments as $med)
                <tr>
                    <td class="fw-medium">{{ $med->libelle }}</td>
                    <td>
                        <span class="badge {{ $med->quantite_med > 5 ? 'bg-success' : 'bg-danger' }}">
                            {{ $med->quantite_med }} en stock
                        </span>
                    </td>
                    <td>{{ $med->prix_med ? $med->prix_med . ' DH' : '-' }}</td>
                    <td>
                        @if($med->dateexp_med)
                            @if($med->dateexp_med->isPast())
                                <span class="text-danger fw-bold"><i class="fa-solid fa-circle-exclamation me-1"></i>Expiré ({{ $med->dateexp_med->format('d/m/Y') }})</span>
                            @else
                                {{ $med->dateexp_med->format('d/m/Y') }}
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('medicaments.edit', $med->id_med) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('medicaments.destroy', $med->id_med) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce médicament ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-4">Aucun médicament en stock.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
