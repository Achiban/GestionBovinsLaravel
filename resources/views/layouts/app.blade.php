<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Bovins - Premium</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            -webkit-font-smoothing: antialiased;
        }

        /* Navbar Premium */
        .navbar-premium {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
        }
        .navbar-premium .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }
        .navbar-premium .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 6px;
        }
        .navbar-premium .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white !important;
            transform: translateY(-1px);
        }

        /* Cards & Containers */
        .premium-card {
            background: var(--card-bg);
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .premium-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Buttons */
        .btn-premium {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.5rem 1.2rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-premium:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.3);
        }

        /* Tables */
        .table-premium {
            background: white;
            border-radius: 12px;
            overflow: hidden;
        }
        .table-premium thead th {
            background: #f1f5f9;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border-bottom: none;
            padding: 1rem;
        }
        .table-premium tbody td {
            padding: 1rem;
            vertical-align: middle;
            color: var(--text-main);
            border-bottom: 1px solid #e2e8f0;
        }

        /* Status Badges */
        .badge-status {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
        }
        .badge-vendu { background: #dcfce7; color: #166534; }
        .badge-mort { background: #fee2e2; color: #991b1b; }
        .badge-actif { background: #dbeafe; color: #1e40af; }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-premium mb-5">
        <div class="container">
            <a class="navbar-brand" href="{{ route('bovins.index') }}">
                <i class="fa-solid fa-cow me-2"></i>AgriBovins
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fa-solid fa-bars text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bovins.index') }}">Bovins</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('etables.index') }}">Étables</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('medicaments.index') }}">Médicaments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('stocks.index') }}">Stock Alimentaire</a>
                    </li>
                    <!-- Dropdown pour les autres entités -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            Plus
                        </a>
                        <ul class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item" href="{{ route('vendeurs.index') }}">Vendeurs</a></li>
                            <li><a class="dropdown-item" href="{{ route('transporteurs.index') }}">Transporteurs</a></li>
                            <li><a class="dropdown-item" href="{{ route('vehicules.index') }}">Véhicules</a></li>
                            <li><a class="dropdown-item" href="{{ route('vetos.index') }}">Vétérinaires</a></li>
                            <li><a class="dropdown-item" href="{{ route('quarantaines.index') }}">Quarantaines</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('visites.index') }}">Visites Vétérinaires</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarUser" role="button" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i> Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
                <i class="fa-solid fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center text-muted py-4 mt-5">
        <p class="mb-0">© {{ date('Y') }} AgriBovins. Conçu pour la performance et l'esthétique.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
