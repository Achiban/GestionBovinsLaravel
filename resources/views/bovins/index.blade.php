@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-list text-primary me-2"></i>Liste des Bovins</h2>
    <a href="{{ route('bovins.create') }}" class="btn btn-premium">
        <i class="fa-solid fa-plus me-1"></i> Ajouter un Bovin
    </a>
</div>

<div class="premium-card p-0">
    <div class="table-responsive">
        <table class="table table-premium mb-0 table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Race</th>
                    <th>Date d'Achat</th>
                    <th>Poids (Kg)</th>
                    <th>Étable</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bovins as $bovin)
                <tr>
                    <td class="fw-bold text-muted">#{{ $bovin->id_bov }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-circle p-2 me-3 text-primary">
                                <i class="fa-solid fa-cow"></i>
                            </div>
                            <span class="fw-medium">{{ $bovin->race ?? 'Non spécifiée' }}</span>
                        </div>
                    </td>
                    <td>{{ $bovin->dateachat ? $bovin->dateachat->format('d/m/Y') : '-' }}</td>
                    <td>{{ $bovin->poidAct ?? $bovin->poidachat ?? '-' }} kg</td>
                    <td>
                        @if($bovin->etable)
                            <span class="badge bg-light text-dark border"><i class="fa-solid fa-house-chimney me-1"></i>{{ $bovin->etable->nom }}</span>
                        @else
                            <span class="text-muted fst-italic">Aucune</span>
                        @endif
                    </td>
                    <td>
                        @if($bovin->mort)
                            <span class="badge badge-status badge-mort"><i class="fa-solid fa-skull me-1"></i>Mort</span>
                        @elseif($bovin->vendu)
                            <span class="badge badge-status badge-vendu"><i class="fa-solid fa-money-bill me-1"></i>Vendu</span>
                        @else
                            <span class="badge badge-status badge-actif"><i class="fa-solid fa-check me-1"></i>Actif</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('bovins.show', $bovin->id_bov) }}" class="btn btn-sm btn-outline-primary" title="Voir les détails">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('bovins.edit', $bovin->id_bov) }}" class="btn btn-sm btn-outline-secondary" title="Modifier">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="fa-solid fa-cow fa-3x mb-3 text-light"></i>
                        <h5>Aucun bovin trouvé</h5>
                        <p>Commencez par ajouter votre premier bovin au système.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
