<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - AgriBovins</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e40af, #2563eb);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e293b;
        }
        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
        }
        .login-header {
            background: #f8fafc;
            padding: 2rem;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
        }
        .login-body {
            padding: 2rem;
        }
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
        }
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
            border-color: #2563eb;
        }
        .btn-login {
            background: #2563eb;
            color: white;
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background: #1e40af;
            color: white;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <h3 class="fw-bold text-primary mb-0"><i class="fa-solid fa-cow me-2"></i>AgriBovins</h3>
            <p class="text-muted mt-2 mb-0">Connectez-vous pour gérer votre ferme</p>
        </div>
        <div class="login-body">
            @if ($errors->any())
                <div class="alert alert-danger rounded-3 border-0 py-2">
                    <ul class="mb-0 ps-3 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-medium text-muted small">Adresse Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-envelope text-muted"></i></span>
                        <input type="email" name="email" class="form-control border-start-0 ps-0" value="{{ old('email') }}" required autofocus placeholder="admin@agribovins.com">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-medium text-muted small">Mot de passe</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-lock text-muted"></i></span>
                        <input type="password" name="password" class="form-control border-start-0 ps-0" required placeholder="••••••••">
                    </div>
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label text-muted small" for="remember">Se souvenir de moi</label>
                </div>

                <button type="submit" class="btn btn-login shadow-sm">Se connecter <i class="fa-solid fa-arrow-right ms-2"></i></button>
            </form>
        </div>
    </div>

</body>
</html>
