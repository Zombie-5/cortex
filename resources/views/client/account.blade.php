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
                        {{ number_format($user->wallet->today, 2, ',', '.') }}</div>
                    <div class="label">Today Earnings</div>
                </div>
                <div class="col-6 text-end">
                    <div class="amount">{{ number_format($user->wallet->daily, 2, ',', '.') }}</div>
                    <div class="label">Daily Earnings</div>
                </div>
            </div>
        </div>

        <!-- Points Card -->
        <div class="balance-card">
            <div class="row">
                <div class="col-6">
                    <div class="amount">{{ number_format(2823.6, 2, ',', '.') }}</div>
                    <div class="label">Total Points</div>
                </div>

                <div class="col-6 text-end">
                    <div class="amount" style="color: var(--primary-green);">
                        {{ number_format($user->wallet->money, 2, ',', '.') }}</div>
                    <div class="label">My Balance</div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button class="action-button">
                <span>Deposit</span>
                <i class="bi bi-arrow-right"></i>
            </button>
            <button class="action-button">
                <span>Withdraw</span>
                <i class="bi bi-arrow-right"></i>
            </button>
        </div>

        <!-- Menu Grid -->
        <div class="menu-grid">
            <a href="#" class="menu-item">
                <i class="bi bi-gift menu-icon d-block"></i>
                <span>Gifts</span>
            </a>
            <a href="#" class="menu-item">
                <i class="bi bi-receipt menu-icon d-block"></i>
                <span>Records</span>
            </a>
            <a href="#" class="menu-item">
                <i class="bi bi-lock menu-icon d-block"></i>
                <span>Password</span>
            </a>
            <a href="#" class="menu-item">
                <i class="bi bi-wallet2 menu-icon d-block"></i>
                <span>Bank</span>
            </a>
            <a href="#" class="menu-item">
                <i class="bi bi-people menu-icon d-block"></i>
                <span>Team</span>
            </a>
            <a href="#" class="menu-item">
                <i class="bi bi-download menu-icon d-block"></i>
                <span>Download</span>
            </a>
        </div>

        <form action="{{ route('auth.signOut') }}" method="POST">
            @csrf
            <button class="log-out" type="submit">Log Out</button>
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
