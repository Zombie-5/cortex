@extends('layouts.client.app')

@section('content')
    <div class="container py-4" style="margin-top: 50px">
        <div class="card bg-white shadow-sm">
            <div class="card-body">
                <!-- Balance Card -->
                <div class="balance-card mb-4"
                    style="background-color: var(--primary-green); border-radius: 10px; padding: 15px;">
                    <div class="d-flex justify-content-between align-items-center text-white">
                        <div>
                            <div class="text-white-50 mb-1">Saldo da conta</div>
                            <div class="h4 mb-0">KZ {{ number_format($user->wallet->money, 2, ',', '.') }}</div>
                        </div>
                        <i class="bi bi-wallet2 fs-4"></i>
                    </div>
                </div>

                <!-- Deposit Form -->
                <form action="{{ route('client.deposit.store') }}" method="POST" id="depositForm">
                    @csrf
                    <!-- Amount Input with Records Button -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label">Montante da recarga</label>
                            <a href="{{ route('client.record.deposit') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">Registros</a>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">KZ</span>
                            <input type="text" class="form-control form-control-lg" name="custom-amount"
                                id="custom-amount" placeholder="5000">
                        </div>
                    </div>

                    <!-- Quick Amount Buttons -->
                    <div class="quick-amounts mb-4">
                        <div class="row g-2 mb-2">
                            <div class="col-3">
                                <button type="button" class="btn btn-outline-primary w-100 rounded-pill amount-btn"
                                    data-value ="10000">10000</button>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-outline-primary w-100 rounded-pill amount-btn"
                                    data-value ="20000">20000</button>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-outline-primary w-100 rounded-pill amount-btn"
                                    data-value ="50000">50000</button>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-outline-primary w-100 rounded-pill amount-btn"
                                    data-value ="100000">1000</button>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-3">
                                <button type="button" class="btn btn-outline-primary w-100 rounded-pill amount-btn"
                                    data-value ="150000">15000</button>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-outline-primary w-100 rounded-pill amount-btn"
                                    data-value ="200000">20000</button>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-outline-primary w-100 rounded-pill amount-btn"
                                    data-value ="500000">50000</button>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-outline-primary w-100 rounded-pill amount-btn"
                                    data-value ="1000000">10000</button>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn w-100 mb-4"
                        style="background-color: var(--primary-green); color: white;">
                        Enviar
                    </button>

                    <!-- Instructions -->
                    <div class="small text-muted">
                        <p class="mb-2">O valor mínimo do depósito é de 10.000KZ (horário de carregamento: 9h00 às 21h00)
                        </p>
                        <p class="mb-2">Processo de recarga:</p>
                        <p class="mb-2">1.° Selecione o mesmo banco para transferir fundos. Os fundos chegarão à conta em
                            10 minutos. Se não utilizar o mesmo banco para transferência, os fundos não chegarão à sua conta
                            a tempo.</p>
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
        document.addEventListener('DOMContentLoaded', () => {
            const amountButtons = document.querySelectorAll('.amount-btn');
            const customAmountInput = document.getElementById('custom-amount');
            let isAmountSelected = false;

            amountButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove a classe 'selected' de todos os botões
                    amountButtons.forEach(btn => btn.classList.remove('selected'));

                    // Define o valor no input oculto
                    customAmountInput.value = '';
                });
            });

            // Adiciona evento aos botões de valor predefinido
            amountButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove a classe 'selected' de todos os botões
                    amountButtons.forEach(btn => btn.classList.remove('selected'));

                    // Adiciona a classe 'selected' ao botão clicado
                    button.classList.add('selected');

                    // Limpa o campo de entrada personalizada
                    customAmountInput.value = button.getAttribute('data-value');
                });
            });

            // Quando o formulário for enviado, verifica se o valor foi definido
            const form = document.getElementById('deposit-form');
            form.addEventListener('submit', (event) => {
                // Se nenhum valor foi selecionado nem no campo customizado nem nos botões, impede o envio do formulário
                if (!customAmountInput.value) {
                    event.preventDefault();
                    alert('Por favor, insira um valor para o depósito.');
                }
            });
        });
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
