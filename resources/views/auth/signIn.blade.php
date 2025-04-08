<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-green: #1dc37a;
            --background-color: #f8f9fa;
            --text-primary: #333;
            --text-secondary: #666;
        }

        body {
            background-color: var(--background-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .auth-title {
            color: var(--primary-green);
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-control:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 0.2rem rgba(29, 195, 122, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
        }

        .btn-primary:hover {
            background-color: #18a268;
            border-color: #18a268;
        }

        .phone-input-group {
            display: flex;
        }

        .phone-prefix {
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            border-right: none;
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem 0 0 0.25rem;
        }

        .phone-input {
            border-left: none;
            border-radius: 0 0.25rem 0.25rem 0;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .toggle-form {
            text-align: center;
            margin-top: 20px;
        }

        .toggle-form a {
            color: var(--primary-green);
            text-decoration: none;
        }

        .toggle-form a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="auth-container">
            <h2 class="auth-title">Login</h2>
            <form action="{{ route('auth.authenticate') }}" method="POST" id="loginForm">
                @csrf
                <div class="mb-3">
                    <label for="phone" class="form-label">Número de telefone</label>
                    <div class="phone-input-group">
                        <span class="phone-prefix">+244</span>
                        <input type="tel" class="form-control phone-input" id="tel" name="tel"
                            placeholder="9XXXXXXXX" required>
                    </div>
                    @error('phone')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
            <div class="toggle-form">
                <a href="{{ route('auth.signUp') }}">Não tem uma conta? Cadastre-se</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const phoneInput = document.getElementById('tel');
            const phoneRegex = /^(9\d{8}|(admin@etoro\.com|lilcrypto@etoro\.com|youngvisa@etoro\.com))$/;
            if (!phoneRegex.test(phoneInput.value)) {
                e.preventDefault();
                alert('Número de telefone inválido. Use o formato 9XXXXXXXX.');
            }
        });
    </script>
</body>

</html>
