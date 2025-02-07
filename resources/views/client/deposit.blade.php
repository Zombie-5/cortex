@extends('layouts.client.app')

@section('content')
<div class="container py-4" style="margin-top: 50px">
    <div class="card bg-white shadow-sm">
        <div class="card-body">
            <!-- Balance Card -->
            <div class="balance-card mb-4" style="background-color: var(--primary-green); border-radius: 10px; padding: 15px;">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <div>
                        <div class="text-white-50 mb-1">Saldo da conta</div>
                        <div class="h4 mb-0">KZ 0</div>
                    </div>
                    <i class="bi bi-wallet2 fs-4"></i>
                </div>
            </div>

            <!-- Deposit Form -->
            <form action="#" method="POST" id="depositForm">
                @csrf
                
                <!-- Amount Input with Records Button -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label">Montante da recarga</label>
                        <a href="#" class="btn btn-outline-secondary btn-sm rounded-pill px-3">Registros</a>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">KZ</span>
                        <input type="text" class="form-control form-control-lg" name="amount" id="amount" value="20000" readonly>
                    </div>
                </div>

                <!-- Quick Amount Buttons -->
                <div class="quick-amounts mb-4">
                    <div class="row g-2 mb-2">
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-primary w-100 rounded-pill amount-btn" data-amount="12000">12000</button>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-primary w-100 rounded-pill amount-btn" data-amount="20000">20000</button>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-primary w-100 rounded-pill amount-btn" data-amount="50000">50000</button>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-primary w-100 rounded-pill amount-btn" data-amount="100000">1000</button>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-primary w-100 rounded-pill amount-btn" data-amount="150000">15000</button>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-primary w-100 rounded-pill amount-btn" data-amount="200000">20000</button>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-primary w-100 rounded-pill amount-btn" data-amount="500000">50000</button>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-outline-primary w-100 rounded-pill amount-btn" data-amount="1000000">10000</button>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn w-100 mb-4" style="background-color: var(--primary-green); color: white;">
                    Enviar
                </button>

                <!-- Instructions -->
                <div class="small text-muted">
                    <p class="mb-2">O valor mínimo do depósito é de 12.000KZ (horário de carregamento: 9h00 às 21h00)</p>
                    <p class="mb-2">Processo de recarga:</p>
                    <p class="mb-2">1.° Selecione o mesmo banco para transferir fundos. Os fundos chegarão à conta em 10 minutos. Se não utilizar o mesmo banco para transferência, os fundos não chegarão à sua conta a tempo.</p>
                    <p class="mb-2">2. Copie o nome do banco, o nome, o número da conta e o valor.</p>
                    <p class="mb-0">3. O valor da transferência deve ser consistente</p>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="toast-container position-fixed top-0 end-0 p-3"></div>
@endsection

@section('script')
<script>
$(document).ready(function() {
    // Handle quick amount buttons
    $('.amount-btn').click(function() {
        const amount = $(this).data('amount');
        $('#amount').val(amount);
        
        // Remove active class from all buttons
        $('.amount-btn').removeClass('active');
        // Add active class to clicked button
        $(this).addClass('active');
    });

    // Form validation
    $("#depositForm").validate({
        rules: {
            confirm: {
                required: true
            }
        },
        messages: {
            confirm: {
                required: "Por favor, confirme a recarga"
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-check').append(error);
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

<style>
    :root {
        --primary-green: #1dc37a;
    }

    .btn-outline-primary {
        color: var(--primary-green);
        border-color: var(--primary-green);
    }
    
    .btn-outline-primary:hover, 
    .btn-outline-primary:focus, 
    .btn-outline-primary.active {
        background-color: var(--primary-green);
        border-color: var(--primary-green);
        color: white;
    }
    
    .form-check-input:checked {
        background-color: var(--primary-green);
        border-color: var(--primary-green);
    }

    .form-check-input:focus {
        border-color: var(--primary-green);
        box-shadow: 0 0 0 0.25rem rgba(29, 195, 122, 0.25);
    }

    .form-control:focus {
        border-color: var(--primary-green);
        box-shadow: 0 0 0 0.25rem rgba(29, 195, 122, 0.25);
    }

    /* Custom styling for amount input */
    .form-control-lg {
        font-size: 1.5rem;
        font-weight: bold;
    }
</style>
@endsection