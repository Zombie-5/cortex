@extends('layouts.client.app')

@section('content')
    <div class="container" style="margin-top: 70px">
        <div class="row">
            @foreach ($products as $product)
                @php
                    $expiresAt = \Carbon\Carbon::parse($product->pivot->expires_at);
                    $lastCollection = \Carbon\Carbon::parse($product->pivot->last_collection);
                    $remainingDays = now()->diffInDays($expiresAt);
                    $collectedToday = $lastCollection->isToday();
                @endphp

                <div class="col-md-6 col-lg-4">
                    <div class="animal-card">
                        <div class="card-image"></div>
                        <div class="card-content">
                            <div class="price-section">
                                <div class="price-amount">{{ $product['name'] }}</div>
                                <button class="feed-button bg-danger">Investindo</button>
                            </div>
                            <div class="stats-grid">
                                <div class="stat-item">
                                    <div class="stat-value">
                                        @if ($collectedToday)
                                            {{ number_format($product['income'], 0, ',', '.') }}
                                        @else
                                            {{ number_format(0, 0, ',', '.') }}
                                        @endif
                                    </div>
                                    <div class="stat-label">Renda de Hoje</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">
                                        {{ $remainingDays }}
                                    </div>
                                    <div class="stat-label">Dias Restantes</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">{{ number_format($product->pivot->income_total, 2, ',', '.') }}</div>
                                    <div class="stat-label">Renda Total</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Floating Support Button -->
    <form action="{{ route('client.claim') }}" method="POST" class="support-button-wrapper" style="margin-bottom: 120px">
        @csrf
        <button class="btn rounded-circle support-button bg-warning">
            <i class="bi bi-hand-index-fill text-white"></i>
        </button>

    </form>
    
@endsection

<style>
    .animal-card {
        background: var(--card-bg);
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .card-image {
        position: relative;
        height: 150px;
        background: url('https://images.prismic.io/contrary-research/65834bbe531ac2845a26d51b_4.png?auto=format,compress') center/cover;
        padding: 15px;
    }

    .card-content {
        padding: 15px;
    }

    .category-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #ff4757;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
    }

    .animal-name {
        color: white;
        font-size: 1.2rem;
        font-weight: 500;
        margin: 0;
    }

    .animal-price {
        color: white;
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        text-align: center;
    }

    .stat-value {
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--primary-green);
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 0.8rem;
        color: var(--text-secondary);
    }

    .price-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        margin-bottom: 15px;
    }

    .price-amount {
        font-size: 1.2rem;
        font-weight: 500;
        color: var(--text-primary);
    }

    .feed-button {
        background: var(--primary-green);
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 0.9rem;
        transition: opacity 0.2s;
    }

    .feed-button:hover {
        opacity: 0.9;
    }

    .additional-info {
        padding: 15px;
        font-size: 0.9rem;
        color: var(--text-secondary);
    }
</style>
