@extends('layouts.client.app')

@section('content')
<div class="container py-4" style="margin-top: 50px">
    <div class="card bg-white shadow-sm">
        <div class="card-body">
            <!-- Balance Card -->
            <div class="balance-card mb-4" style="background-color: var(--primary-green); border-radius: 10px; padding: 15px;">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div>
                        <div class="text-white-50 mb-1">Saldo disponível</div>
                        <div class="h4 mb-0">KZ 500</div>
                    </div>
                    <i class="bi bi-wallet2 fs-4"></i>
                </div>
            </div>

            <!-- Withdrawal Form -->
            <form action="#" method="POST" id="withdrawalForm">
                @csrf
                
                <!-- Withdrawal Method -->
                <div class="mb-3">
                    <label class="form-label">Método de levantamento</label>
                    <select class="form-select" name="withdrawal_method" required>
                        <option value="">Selecione o método</option>
                        <option value="bank">Transferência Bancária</option>
                    </select>
                </div>

                <!-- Bank Account -->
                <div class="mb-3">
                    <label class="form-label">Conta bancária</label>
                    <select class="form-select" name="bank_account" required>
                        <option value="">Selecione a conta</option>
                        <option value="1">Conta Principal</option>
                    </select>
                </div>

                <!-- Amount -->
                <div class="mb-3">
                    <label class="form-label">Montante da retirada</label>
                    <div class="input-group">
                        <span class="input-group-text">KZ</span>
                        <input type="number" class="form-control" name="amount" min="3300" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn w-100 mb-3" style="background-color: var(--primary-green); color: white;">
                    Confirmar
                </button>

                <a type="submit" class="btn w-100 mb-4 btn-outline-secondary">
                    Registros
                </a>

                <!-- Information Text -->
                <div class="small text-muted">
                    <p class="mb-2">1: O saque mínimo é 3300KZ e a taxa de saque é de 10%</p>
                    <p class="mb-0">2: Horário de solicitação de saque: 9h às 21h (o saque pode ser solicitado de segunda a domingo). Após uma solicitação de saque, os fundos chegarão à conta em 24 horas.</p>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Toast Container for Notifications -->
<div class="toast-container position-fixed top-0 end-0 p-3"></div>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
$(document).ready(function() {
    $("#withdrawalForm").validate({
        rules: {
            withdrawal_method: {
                required: true
            },
            bank_account: {
                required: true
            },
            amount: {
                required: true,
                min: 3300,
                max: function() {
                    return parseFloat(500); // Replace with actual balance
                }
            }
        },
        messages: {
            withdrawal_method: {
                required: "Por favor, selecione um método de levantamento"
            },
            bank_account: {
                required: "Por favor, selecione uma conta bancária"
            },
            amount: {
                required: "Por favor, insira o montante",
                min: "O valor mínimo de saque é 3300KZ",
                max: "O valor não pode exceder seu saldo disponível"
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
            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processando...');
            
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
@if(session('success'))
    showToast("{{ session('success') }}", 'success');
@endif

@if(session('error'))
    showToast("{{ session('error') }}", 'error');
@endif
</script>
@endsection