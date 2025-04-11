@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <!-- Cabeçalho com Botões -->
        <div class="row">
            <div class="col-md-12 d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Transações</h1>
                <div class="btn-group">
                    <a href="{{ route('admin.transactions.deposits') }}" class="btn btn-primary btn-sm {{ request()->routeIs('admin.transactions.deposits') ? 'active' : '' }}">
                        Depósitos
                    </a>
                    <a href="{{ route('admin.transactions.withdrawals') }}" class="btn btn-primary btn-sm {{ request()->routeIs('admin.transactions.withdrawals') ? 'active' : '' }}">
                        Retiradas
                    </a>
                    <a href="{{ route('admin.transactions.history') }}" class="btn btn-primary btn-sm {{ request()->routeIs('admin.transactions.history') ? 'active' : '' }}">
                        Histórico
                    </a>
                </div>
            </div>
        </div>

        <!-- Área para o conteúdo específico -->
        @yield('transaction_content')
    </div>
@endsection
<style>
    .status-pendente { color: gray; }
    .status-processando { color: orange; }
    .status-concluido { color: green; }
    .status-rejeitado { color: red; }
    select {
        border: none;
        outline: none;
        box-shadow: none;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }
    .btn-group .btn {
        margin-right: 5px;
    }
    .btn-group .btn.active {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }
</style>