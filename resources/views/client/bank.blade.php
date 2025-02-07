@extends('layouts.client.app')

@section('content')
    @php
        // Exemplo de dados bancários (simulando dados do banco de dados)
        $bankInfo = (object) [
            'bank_name' => 'BFA',
            'account_number' => '1234567890',
            'account_holder' => 'João da Silva',
            'iban' => 'AO06000600000100037131174',
            'swift' => 'BFMXAOLN',
        ];
    @endphp
    <div class="container py-4" style="margin-top: 50px">
        <div class="card bg-white shadow-sm">
            <div class="card-body">
                <h5 class="mb-4" style="color: var(--primary-green);">Informações Bancárias</h5>

                <form action="#" method="POST" id="bankInfoForm">
                    @csrf
                    @method('PUT')

                    <!-- Nome do Banco -->
                    <div class="mb-3">
                        <label class="form-label">Nome do Banco</label>
                        <select class="form-select" name="bank_name" required>
                            <option value="BAI" {{ $bankInfo->bank_name == 'BAI' ? 'selected' : '' }}>BAI</option>
                            <option value="BFA" {{ $bankInfo->bank_name == 'BFA' ? 'selected' : '' }}>BFA</option>
                            <option value="BIC" {{ $bankInfo->bank_name == 'BIC' ? 'selected' : '' }}>BIC</option>
                            <option value="BPC" {{ $bankInfo->bank_name == 'BPC' ? 'selected' : '' }}>BPC</option>
                        </select>
                        @error('bank_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Número da Conta -->
                    <div class="mb-3">
                        <label class="form-label">Número da Conta</label>
                        <input type="text" class="form-control" name="account_number"
                            value="{{ old('account_number', $bankInfo->account_number ?? '') }}" required>
                        @error('account_number')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Titular da Conta -->
                    <div class="mb-3">
                        <label class="form-label">Titular da Conta</label>
                        <input type="text" class="form-control" name="account_holder"
                            value="{{ old('account_holder', $bankInfo->account_holder ?? '') }}" required>
                        @error('account_holder')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- IBAN -->
                    <div class="mb-3">
                        <label class="form-label">IBAN</label>
                        <input type="text" class="form-control" name="iban"
                            value="{{ old('iban', $bankInfo->iban ?? '') }}">
                        @error('iban')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- SWIFT/BIC -->
                    <div class="mb-4">
                        <label class="form-label">Endereço (Opcional)</label>
                        <input type="text" class="form-control" name="swift"
                            value="{{ old('swift', $bankInfo->swift ?? '') }}">
                        @error('swift')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn w-100" style="background-color: var(--primary-green); color: white;">
                        Salvar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3"></div>

    <style>
        :root {
            --primary-green: #1dc37a;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 0.25rem rgba(29, 195, 122, 0.25);
        }

        .form-control,
        .form-select {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
        }

        .form-label {
            font-weight: 500;
            color: #444;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .invalid-feedback {
            font-size: 0.875rem;
        }
    </style>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            // Form validation
            $("#bankInfoForm").validate({
                rules: {
                    bank_name: {
                        required: true
                    },
                    account_number: {
                        required: true,
                        minlength: 10
                    },
                    account_holder: {
                        required: true,
                        minlength: 3
                    },
                    iban: {
                        minlength: 15
                    },
                    swift: {
                        minlength: 8
                    }
                },
                messages: {
                    bank_name: {
                        required: "Por favor, selecione o banco"
                    },
                    account_number: {
                        required: "Por favor, insira o número da conta",
                        minlength: "O número da conta deve ter pelo menos 10 caracteres"
                    },
                    account_holder: {
                        required: "Por favor, insira o nome do titular",
                        minlength: "O nome deve ter pelo menos 3 caracteres"
                    },
                    iban: {
                        minlength: "O IBAN deve ter pelo menos 15 caracteres"
                    },
                    swift: {
                        minlength: "O código SWIFT deve ter pelo menos 8 caracteres"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.mb-3').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    // Show loading state
                    const submitBtn = $(form).find('button[type="submit"]');
                    const originalText = submitBtn.text();
                    submitBtn.prop('disabled', true).html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processando...'
                    );

                    // Submit form
                    form.submit();
                }
            });
        });

        // Function to show toast notifications
        function showToast(message, type = 'success') {
            const toastHtml = `
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">${type.charAt(0).toUpperCase() + type.slice(1)}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
        </div>
    `;

            $('.toast-container').append(toastHtml);
            const toast = new bootstrap.Toast($('.toast').last());
            toast.show();
        }

        // Show any flash messages
        @if (session('success'))
            showToast("{{ session('success') }}", 'success');
        @endif

        @if (session('error'))
            showToast("{{ session('error') }}", 'error');
        @endif
    </script>
@endsection
