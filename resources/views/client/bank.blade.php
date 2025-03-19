@extends('layouts.client.app')

@section('content')
    <div class="container py-4" style="margin-top: 50px">
        <div class="card bg-white shadow-sm">
            <div class="card-body">
                <h5 class="mb-4" style="color: var(--primary-green);">Informações Bancárias</h5>

                <form action="{{ route('client.bank.store') }}" method="POST" id="bankInfoForm">
                    @csrf
                    <!-- Nome do Banco -->
                    <div class="mb-3">
                        <label class="form-label">Nome do Banco</label>
                        <select class="form-select" name="name" required>
                            <option value="BAI" {{ isset($bankInfo) && $bankInfo->name == 'BAI' ? 'selected' : '' }}>BAI
                            </option>
                            <option value="BFA" {{ isset($bankInfo) && $bankInfo->name == 'BFA' ? 'selected' : '' }}>BFA
                            </option>
                            <option value="BIC" {{ isset($bankInfo) && $bankInfo->name == 'BIC' ? 'selected' : '' }}>BIC
                            </option>
                            <option value="BPC" {{ isset($bankInfo) && $bankInfo->name == 'BPC' ? 'selected' : '' }}>BPC
                            </option>
                            <option value="ATL" {{ isset($bankInfo) && $bankInfo->name == 'ATL' ? 'selected' : '' }}>ATL
                            </option>
                            <option value="BINANCE"
                                {{ isset($bankInfo) && $bankInfo->name == 'BINANCE' ? 'selected' : '' }}>BINANCE</option>
                        </select>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Titular da Conta -->
                    <div class="mb-3">
                        <label class="form-label">Titular da Conta</label>
                        <input type="text" class="form-control" name="owner"
                            value="{{ old('owner', $bankInfo->owner ?? '') }}" required>
                        @error('owner')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- IBAN -->
                    <div class="mb-3">
                        <label class="form-label">Iban / Address</label>
                        <input type="text" class="form-control" name="iban"
                            value="{{ old('iban', $bankInfo->iban ?? '') }}">
                        @error('iban')
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
                    name: {
                        required: true
                    },
                    owner: {
                        required: true,
                        minlength: 3
                    },
                    iban: {
                        required: true,
                        minlength: 15
                    },
                },
                messages: {
                    name: {
                        required: "Por favor, selecione o banco"
                    },
                    owner: {
                        required: "Por favor, insira o nome do titular",
                        minlength: "O nome deve ter pelo menos 3 caracteres"
                    },
                    iban: {
                        required: "Por favor, insira o iban / endereço",
                        minlength: "O Iban / endereço deve ter pelo menos 15 caracteres"
                    },
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
