@extends('layouts.client.app')

@section('content')
    <div class="container" style="margin-top: 80px">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="https://m.media-amazon.com/images/I/51bgFEDvoNL.png" alt="Logo" class="rounded-circle"
                        style="width: 70px; height: 70px; background: white; padding: 5px;">
                    <div class="ms-3">
                        <div style="font-size: 1.5rem">{{ $user->tel }}</div>
                        <div class="user-id">ID: {{ $user->id }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Balance Cards -->
        <div class="balance-card">
            <div class="row">
                <div class="col-6">
                    <div class="amount" style="color: var(--primary-green);">
                        {{ number_format($user->wallet->today, 0, ',', '.') }}</div>
                    <div class="label">Renda de Hoje</div>
                </div>
                <div class="col-6 text-end">
                    <div class="amount">{{ number_format($user->wallet->daily, 0, ',', '.') }}</div>
                    <div class="label">Renda Diária</div>
                </div>
            </div>
        </div>

        <!-- Points Card -->
        <div class="balance-card">
            <div class="row">
                <div class="col-6">
                    <div class="amount">{{ number_format($user->wallet->points, 0, ',', '.') }}</div>
                    <div class="label">CashBacks</div>
                </div>

                <div class="col-6 text-end">
                    <div class="amount" style="color: var(--primary-green);">
                        {{ number_format($user->wallet->money, 0, ',', '.') }}</div>
                    <div class="label">Meu saldo</div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('client.deposit') }}" class="action-button text-decoration-none">
                <span>Depositar</span>
                <i class="bi bi-arrow-right"></i>
            </a>
            <a href="{{ route('client.withdraw') }}" class="action-button text-decoration-none">
                <span>Retirar</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <!-- Menu Grid -->
        <div class="menu-grid">
            
            <a href="{{ route('client.team') }}" class="menu-item">
                <i class="bi bi-people menu-icon d-block"></i>
                <span>Equipe</span>
            </a>
            <a href="{{ route('client.record') }}" class="menu-item">
                <i class="bi bi-receipt menu-icon d-block"></i>
                <span>Registros</span>
            </a>
            <a href="{{ route('client.bank') }}" class="menu-item">
                <i class="bi bi-wallet2 menu-icon d-block"></i>
                <span>Banco</span>
            </a>
            <a href="{{ route('client.gift') }}" class="menu-item">
                <i class="bi bi-gift menu-icon d-block"></i>
                <span>Presentes</span>
            </a>
            <a href="{{ route('client.change-passord') }}" class="menu-item">
                <i class="bi bi-lock menu-icon d-block"></i>
                <span>Senha</span>
            </a>
            <a href="https://www.etoro.com/about/" class="menu-item">
                <i class="bi bi-info-circle menu-icon d-block"></i>
                <span>Nós</span>
            </a>
        </div>

        <form action="{{ route('auth.signOut') }}" method="POST">
            @csrf
            <button class="log-out" type="submit">Terminar Sessão</button>
        </form>
    </div>
@endsection

<style>
    body {}

    .profile-header {
        margin-bottom: 30px;
        color: var(--text-primary);
    }

    .user-id {
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    .balance-card,
    .points-card,
    .action-button,
    .menu-grid {
        background: var(--card-bg);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .log-out {
        background: var(--primary-green);
        color: var(--light-gray);
        border-radius: 15px;
        border: none;
        width: 100%;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
</style>
