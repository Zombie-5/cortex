<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
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
     <style>
        .custom-toast {
            background-color: #333;
            color: #fff;
            padding: 0.75rem 1.25rem;
            border-radius: 12px;
            min-width: 180px;
            display: flex;
            flex-direction: column;
            /* Muda de linha ao invés de linha-horizontal */
            align-items: center;
            /* Centraliza tudo */
            font-size: 0.85rem;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            animation: fadeSlideIn 0.3s ease;
            gap: 0.5rem;
            /* Espaço entre ícone e texto */
            text-align: center;
        }

        .custom-toast .icon svg {
            width: 24px;
            height: 24px;
            animation: popIn 0.3s ease;
        }

        @keyframes fadeSlideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes popIn {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
</head>

<body>
     <!-- Custom Centered Toast Container -->
    <div class="custom-toast-container position-fixed top-50 start-50 translate-middle p-3 d-flex flex-column gap-2 align-items-center"
        style="z-index: 1055;"></div>

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
                    <label for="invite_code" class="form-label">Código de convite</label>
                    <input type="text" class="form-control" value="{{ old('invite_code', $invite_code) }}" id="invite_code" name="invite_code" required>
                    @error('invite_code')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
            </form>
            <div class="toggle-form">
                <a href="{{ route('auth.signIn') }}">Já tem uma conta? Faça login</a>
            </div>
        </div>
    </div>

    <!-- Add this before closing body tag -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts para Toast -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function showCustomToast(message, type = 'success') {
            let svgIcon = '';

            switch (type) {
                case 'success':
                    svgIcon =
                        `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>`;
                    break;
                case 'error':
                    svgIcon =
                        `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>`;
                    break;
                case 'loading':
                    svgIcon =
                        `<svg class="spin" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-opacity="0.3"/><path d="M12 2a10 10 0 0 1 10 10" /></svg>`;
                    break;
                case 'custom':
                    svgIcon =
                        `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20l9-5-9-5-9 5 9 5z"/><path d="M12 12V4"/></svg>`;
                    break;
                default:
                    svgIcon =
                        `<svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/></svg>`;
            }

            const toastHtml = `
            <div class="custom-toast">
                <div class="icon">${svgIcon}</div>
                <div>${message}</div>
            </div>
        `;

            const container = document.querySelector('.custom-toast-container');
            const toastElement = document.createElement('div');
            toastElement.innerHTML = toastHtml;
            container.appendChild(toastElement);

            setTimeout(() => {
                toastElement.remove();
            }, 3000);
        }

        @if (session('success'))
            showCustomToast(@json(session('success')), 'success');
        @endif

        @if (session('error'))
            showCustomToast(@json(session('error')), 'error');
        @endif
    </script>

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                showCustomToast(@json($error), 'error');
            @endforeach
        </script>
    @endif
    <script src="{{ asset('assets/js/validate/messages_pt_PT.js') }}"></script>
</body>

</html>
