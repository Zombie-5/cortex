<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add this to the head section of your auth pages -->
    <style>
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        .toast {
            background: #333;
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            min-width: 200px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: slideIn 0.3s ease-out;
        }

        .toast-icon {
            width: 24px;
            height: 24px;
            margin-right: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toast-message {
            font-size: 0.9rem;
        }

        .toast.success .toast-icon {
            color: #1dc37a;
        }

        .toast.error .toast-icon {
            color: #ff4757;
        }

        .toast.loading .toast-icon {
            animation: spin 1s linear infinite;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="auth-container">
            <h2 class="auth-title">Cadastro</h2>
            <form action="{{ route('auth.store') }}" method="POST" id="signup-form">
                @csrf
                <div class="mb-3">
                    <label for="phone" class="form-label">Número de telefone</label>
                    <div class="phone-input-group">
                        <span class="phone-prefix">+244</span>
                        <input type="tel" class="form-control phone-input" id="phone" name="tel"
                            placeholder="9XXXXXXXX" required>
                    </div>
                </div>
            
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar senha</label>
                    <input type="password" class="form-control" id="password2" name="password_confirmation" required>
                </div>
                <div class="mb-3">
                    <label for="invite_code" class="form-label">Código de convite</label>
                    <input type="text" class="form-control" id="invite_code" name="invite_code" required>
                    @error('invite_code')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
            </form>
            <div class="toast-container" id="toastContainer"></div>
            <div class="toggle-form">
                <a href="{{ route('auth.signIn') }}">Já tem uma conta? Faça login</a>
            </div>
        </div>
    </div>

    <!-- Add this before closing body tag -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;

            let icon = '';
            switch (type) {
                case 'success':
                    icon =
                        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>';
                    break;
                case 'error':
                    icon =
                        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>';
                    break;
                case 'loading':
                    icon =
                        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>';
                    break;
            }

            toast.innerHTML = `
            <div class="toast-icon">${icon}</div>
            <div class="toast-message">${message}</div>
        `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                toast.style.transition = 'all 0.3s ease-out';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Update your form submission handlers to use the toast
        $("#signup-form").on('submit', function(e) {
            if ($(this).valid()) {
                showToast('Processando...', 'loading');
            } else {
                e.preventDefault();
            }
        });

        // If there are any Laravel flash messages, show them as toasts
        @if (session('success'))
            showToast("{{ session('success') }}", 'success');
        @endif

        @if (session('error'))
            showToast("{{ session('error') }}", 'error');
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                showToast("{{ $error }}", 'error');
            @endforeach
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $.validator.addMethod("noNumbers", function(value, element) {
                return this.optional(element) || /^[^0-9]*$/.test(value);
            }, "O campo não pode conter números.");

            $("#signup-form").validate({
                rules: {
                    tel: {
                        required: true,
                        digits: true,
                        minlength: 9,
                        maxlength: 9
                    },
                    password: {
                        required: true,
                        minlength: 6,
                    },
                    password2: {
                        required: true,
                        equalTo: "#password",
                    }
                },
                messages: {
                    tel: {
                        required: "Por favor, insira o número de telefone",
                        digits: "Por favor, insira apenas dígitos",
                        minlength: "O número de telefone deve ter 9 dígitos",
                        maxlength: "O número de telefone deve ter 9 dígitos"
                    },
                    password: {
                        required: "Por favor, insira uma senha",
                        minlength: "A senha deve ter pelo menos 6 caracteres"
                    },
                    password2: {
                        required: "Por favor, confirme a senha",
                        equalTo: "As senhas não coincidem"
                    }
                },
                errorPlacement: function(error, element) {
                    error.addClass("error-message");
                    error.insertAfter(element);
                },
                highlight: function(element) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });
        });
    </script>
    <script src="{{ asset('assets/js/validate/messages_pt_PT.js') }}"></script>
</body>

</html>
