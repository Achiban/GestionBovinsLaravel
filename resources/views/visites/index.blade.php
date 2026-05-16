@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-stethoscope text-primary me-2"></i>Historique des Visites</h2>
    <a href="{{ route('visites.create') }}" class="btn btn-premium">
        <i class="fa-solid fa-plus me-1"></i> Nouvelle Visite
    </a>
</div>

<div class="premium-card p-0">
    <div class="table-responsive">
        <table class="table table-premium mb-0 table-hover">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Bovin (Patient)</th>
                    <th>Vétérinaire</th>
                    <th>Description</th>
                    <th>Frais (DH)</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($visites as $visite)
                <tr>
                    <td class="fw-bold">{{ $visite->datepres ? $visite->datepres->format('d/m/Y') : '-' }}</td>
                    <td>
                        <a href="{{ route('bovins.show', $visite->id_bov) }}" class="text-decoration-none">
                            Bovin #{{ $visite->id_bov }} {{ $visite->bovin->race ? '('.$visite->bovin->race.')' : '' }}
                        </a>
                    </td>
                    <td>{{ $visite->veto ? 'Dr. ' . $visite->veto->nom_vet : 'Non spécifié' }}</td>
                    <td><span class="text-muted text-truncate d-inline-block" style="max-width: 250px;">{{ $visite->description_v ?? '-' }}</span></td>
                    <td>{{ $visite->prix_pres ?? '0' }} DH</td>
                    <td class="text-end">
                        <div class="btn-group">
                            <a href="{{ route('visites.edit', $visite->id_pres) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('visites.destroy', $visite->id_pres) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette visite ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4">Aucune visite enregistrée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
