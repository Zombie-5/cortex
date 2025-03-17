@extends('layouts.client.app')

@section('content')
<div class="container py-4" style="margin-top: 50px">
    <div class="card bg-white shadow-sm">
        <div class="card-body">
            <h5 class="mb-4" style="color: var(--primary-green);">Selecione o Banco</h5>

            <!-- Seleção de Banco -->
            <div class="mb-4">
                <label for="bankSelect" class="form-label">Banco</label>
                <select class="form-select" id="bankSelect">
                    <option value="" selected disabled>Escolha um banco</option>
                    @foreach($banks as $bank)
                        <option value="{{ $bank->name }}">{{ $bank->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Detalhes do Banco (visível desde o início) -->
            <div id="bankDetails" class="mt-4">
                <div class="card border-0 bg-light">
                    <div class="card-body">
                        
                        <!-- Proprietário -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label mb-1">Proprietário da Conta</label>
                            </div>
                            <div class="form-control bg-white clickable-copy" id="bankOwner">
                               ---
                            </div>
                        </div>

                        <!-- IBAN -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label mb-1">IBAN</label>
                            </div>
                            <div class="form-control bg-white clickable-copy" id="bankIban">
                                ---
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botão Concluído -->
            <div class="mt-4 d-grid">
                <a class="btn btn-lg" style="background-color: var(--primary-green); color: white;" href="{{ route('client.record.deposit') }}">Concluido</a>
            </div>
        </div>
    </div>
</div>

<!-- Toast para notificação de cópia -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="copyToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto" style="color: var(--primary-green);">Sucesso</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Copiado para a área de transferência!
        </div>
    </div>
    
    <!-- Toast para notificação de conclusão -->
    <div id="doneToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto" style="color: var(--primary-green);">Sucesso</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Operação concluída com sucesso!
        </div>
    </div>
</div>

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

.copy-btn:hover {
    color: var(--primary-green);
    border-color: var(--primary-green);
}

.copy-btn:focus {
    box-shadow: 0 0 0 0.25rem rgba(29, 195, 122, 0.25);
}

/* Estilo para o campo de texto somente leitura */
.form-control.bg-white {
    cursor: text;
    user-select: all;
}

/* Estilo para campos clicáveis para cópia */
.clickable-copy {
    cursor: pointer;
    position: relative;
    transition: background-color 0.2s;
}

.clickable-copy:hover {
    background-color: #f8f9fa;
}

.clickable-copy:active {
    background-color: #e9ecef;
}

.clickable-copy::after {
    content: "Clique para copiar";
    position: absolute;
    top: -30px;
    left: 50%;
    transform: translateX(-50%);
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    opacity: 0;
    transition: opacity 0.2s;
    pointer-events: none;
}

.clickable-copy:hover::after {
    opacity: 1;
}

/* Estilo para o botão concluído */
.btn-lg {
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    border-radius: 0.5rem;
    transition: all 0.3s;
}

.btn-lg:hover {
    opacity: 0.9;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn-lg:active {
    transform: translateY(0);
    box-shadow: none;
}
</style>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Obter os dados dos bancos da view
    const banks = @json($banks);
    
    // Converter para um objeto indexado pelo nome do banco para fácil acesso
    const bankData = {};
    banks.forEach(bank => {
        bankData[bank.name] = {
            iban: bank.iban,
            owner: bank.owner
        };
    });

    // Elementos DOM
    const bankSelect = document.getElementById('bankSelect');
    const bankIban = document.getElementById('bankIban');
    const bankOwner = document.getElementById('bankOwner');
    const copyButtons = document.querySelectorAll('.copy-btn');
    const clickableCopyElements = document.querySelectorAll('.clickable-copy');
    const doneButton = document.getElementById('doneButton');
    const copyToast = new bootstrap.Toast(document.getElementById('copyToast'));
    const doneToast = new bootstrap.Toast(document.getElementById('doneToast'));

    // Evento de mudança no select
    bankSelect.addEventListener('change', function() {
        const selectedBank = this.value;
        
        if (selectedBank && bankData[selectedBank]) {
            // Atualizar os detalhes do banco
            bankIban.textContent = bankData[selectedBank].iban;
            bankOwner.textContent = bankData[selectedBank].owner;
        }
    });

    // Função para copiar texto
    function copyText(text) {
        // Verificar se a API Clipboard está disponível
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text)
                .then(() => {
                    copyToast.show();
                })
                .catch(err => {
                    console.error('Erro ao copiar texto: ', err);
                    fallbackCopyText(text);
                });
        } else {
            fallbackCopyText(text);
        }
    }

    // Método alternativo para copiar texto
    function fallbackCopyText(text) {
        const tempInput = document.createElement('textarea');
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        copyToast.show();
    }

    // Adicionar evento de clique aos botões de cópia
    copyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-copy');
            const textToCopy = document.getElementById(targetId).textContent;
            copyText(textToCopy);
        });
    });

    // Adicionar evento de clique aos elementos clicáveis para cópia
    clickableCopyElements.forEach(element => {
        element.addEventListener('click', function() {
            const textToCopy = this.textContent.trim();
            copyText(textToCopy);
            
            // Efeito visual de feedback
            const originalBg = this.style.backgroundColor;
            this.style.backgroundColor = '#d4edda';
            setTimeout(() => {
                this.style.backgroundColor = originalBg;
            }, 300);
        });
    });
});
</script>
@endsection