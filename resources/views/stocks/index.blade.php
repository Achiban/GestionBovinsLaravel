@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-wheat-awn text-primary me-2"></i>Stock Alimentaire</h2>
    <a href="{{ route('stocks.create') }}" class="btn btn-premium">
        <i class="fa-solid fa-plus me-1"></i> Ajouter au Stock
    </a>
</div>

<div class="premium-card p-0">
    <div class="table-responsive">
        <table class="table table-premium mb-0 table-hover">
            <thead>
                <tr>
                    <th>Libellé</th>
                    <th>Quantité Initiale</th>
                    <th>Quantité Actuelle</th>
                    <th>Prix</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stocks as $stock)
                <tr>
                    <td class="fw-medium">{{ $stock->libelle_st }}</td>
                    <td>{{ $stock->quantite_s }}</td>
                    <td>
                        <span class="badge {{ $stock->quantiteAct > 20 ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $stock->quantiteAct }} kg
                        </span>
                    </td>
                    <td>{{ $stock->prix_s ? $stock->prix_s . ' DH' : '-' }}</td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('stocks.edit', $stock->id_stock) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('stocks.destroy', $stock->id_stock) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cet aliment ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-4">Aucun stock alimentaire.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
