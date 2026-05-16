@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0 text-dark">
        <i class="fa-solid fa-cow text-primary me-2"></i>Détails du Bovin #{{ $bovin->id_bov }}
    </h2>
    <a href="{{ route('bovins.index') }}" class="btn btn-outline-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i> Retour
    </a>
</div>

<div class="row">
    <!-- Colonne Principale -->
    <div class="col-md-8">
        <div class="premium-card p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-primary mb-0">Informations Générales</h4>
                <div>
                    @if($bovin->mort)
                        <span class="badge badge-status badge-mort"><i class="fa-solid fa-skull me-1"></i>Mort le {{ $bovin->datemort->format('d/m/Y') }}</span>
                    @elseif($bovin->vendu)
                        <span class="badge badge-status badge-vendu"><i class="fa-solid fa-money-bill me-1"></i>Vendu le {{ $bovin->datevente->format('d/m/Y') }}</span>
                    @else
                        <span class="badge badge-status badge-actif"><i class="fa-solid fa-check me-1"></i>En ferme</span>
                    @endif
                </div>
            </div>

            <div class="row g-4">
                <div class="col-sm-6">
                    <div class="d-flex flex-column bg-light p-3 rounded-3 h-100">
                        <span class="text-muted small text-uppercase fw-bold mb-1">Race</span>
                        <span class="fs-5 fw-medium">{{ $bovin->race ?? 'Non spécifiée' }}</span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex flex-column bg-light p-3 rounded-3 h-100">
                        <span class="text-muted small text-uppercase fw-bold mb-1">Poids Actuel</span>
                        <span class="fs-5 fw-medium">{{ $bovin->poidAct ?? '-' }} kg</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="d-flex flex-column bg-light p-3 rounded-3 h-100">
                        <span class="text-muted small text-uppercase fw-bold mb-1">Date d'achat</span>
                        <span class="fs-6 fw-medium">{{ $bovin->dateachat ? $bovin->dateachat->format('d/m/Y') : '-' }}</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="d-flex flex-column bg-light p-3 rounded-3 h-100">
                        <span class="text-muted small text-uppercase fw-bold mb-1">Prix d'achat</span>
                        <span class="fs-6 fw-medium">{{ $bovin->prixachat ? $bovin->prixachat . ' DH' : '-' }}</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="d-flex flex-column bg-light p-3 rounded-3 h-100">
                        <span class="text-muted small text-uppercase fw-bold mb-1">Étable actuelle</span>
                        <span class="fs-6 fw-medium">{{ $bovin->etable ? $bovin->etable->nom : 'Aucune' }}</span>
                    </div>
                </div>
            </div>
        </div>

        @if($bovin->vendu)
        <div class="premium-card p-4 mb-4 border-start border-success border-4">
            <h4 class="fw-bold text-success mb-3"><i class="fa-solid fa-money-bill-wave me-2"></i>Détails de la Vente</h4>
            <div class="row">
                <div class="col-md-3"><span class="text-muted">Date:</span> <br><strong>{{ $bovin->datevente->format('d/m/Y') }}</strong></div>
                <div class="col-md-3"><span class="text-muted">Prix:</span> <br><strong>{{ $bovin->prixavente }} DH</strong></div>
                <div class="col-md-3"><span class="text-muted">Poids:</span> <br><strong>{{ $bovin->poidvente }} kg</strong></div>
                <div class="col-md-3"><span class="text-muted">Lieu:</span> <br><strong>{{ $bovin->lieuvente }}</strong></div>
            </div>
        </div>
        @endif
    </div>

    <!-- Colonne Actions Rapides -->
    <div class="col-md-4">
        <div class="premium-card p-4 mb-4">
            <h5 class="fw-bold mb-3"><i class="fa-solid fa-bolt text-warning me-2"></i>Actions Rapides</h5>
            
            <div class="d-grid gap-2">
                @if(!$bovin->vendu && !$bovin->mort)
                    <!-- Bouton Vendre -->
                    <button type="button" class="btn btn-outline-success text-start" data-bs-toggle="modal" data-bs-target="#modalVendre">
                        <i class="fa-solid fa-money-bill me-2"></i> Déclarer Vendu
                    </button>
                    
                    <!-- Bouton Mort -->
                    <button type="button" class="btn btn-outline-danger text-start" data-bs-toggle="modal" data-bs-target="#modalMort">
                        <i class="fa-solid fa-skull me-2"></i> Déclarer Mort
                    </button>

                    <hr class="my-2">
                    
                    <!-- Médicament -->
                    <button type="button" class="btn btn-outline-primary text-start" data-bs-toggle="modal" data-bs-target="#modalMedicament">
                        <i class="fa-solid fa-pills me-2"></i> Administrer Médicament
                    </button>
                    
                    <!-- Alimentation -->
                    <button type="button" class="btn btn-outline-info text-start" data-bs-toggle="modal" data-bs-target="#modalAlimentation">
                        <i class="fa-solid fa-wheat-awn me-2"></i> Donner Alimentation
                    </button>
                @else
                    <div class="alert alert-secondary mb-0">
                        <i class="fa-solid fa-info-circle me-1"></i> Ce bovin n'est plus actif. Aucune action ne peut être effectuée.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Vendre -->
<div class="modal fade" id="modalVendre" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('bovins.vendre', $bovin->id_bov) }}" method="POST">
                @csrf
                <div class="modal-header bg-success text-white border-0">
                    <h5 class="modal-title"><i class="fa-solid fa-money-bill-wave me-2"></i>Vendre le Bovin</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Date de vente</label>
                        <input type="date" name="datevente" class="form-control" required value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prix de vente (DH)</label>
                        <input type="number" step="0.01" name="prixavente" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Poids à la vente (kg)</label>
                        <input type="number" step="0.01" name="poidvente" class="form-control" required value="{{ $bovin->poidAct }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lieu de vente</label>
                        <input type="text" name="lieuvente" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Confirmer la vente</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Mort -->
<div class="modal fade" id="modalMort" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('bovins.marquerMort', $bovin->id_bov) }}" method="POST">
                @csrf
                <div class="modal-header bg-danger text-white border-0">
                    <h5 class="modal-title"><i class="fa-solid fa-skull me-2"></i>Déclarer le Bovin Mort</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <p>Êtes-vous sûr de vouloir déclarer ce bovin comme mort ? Cette action changera son statut de façon permanente.</p>
                    <div class="mb-3">
                        <label class="form-label">Date du décès</label>
                        <input type="date" name="datemort" class="form-control" required value="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Confirmer le décès</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Note : Les modals pour Médicament et Alimentation devront avoir accès à la liste des médicaments/stocks depuis le contrôleur si besoin -->

@endsection
