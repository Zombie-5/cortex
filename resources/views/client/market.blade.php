@extends('layouts.client.app')

@section('content')
    <div class="container" style="margin-top: 70px">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-6 col-lg-4">
                    <div class="animal-card">
                        <div class="card-image"></div>
                        <div class="card-content">
                            <div class="name-section">
                                <div class="name-amount">{{ $product['name'] }}</div>
                                <div>
                                    {{ $product['purchase_count'] }} / 4
                                </div>
                            </div>
                            <div class="price-section">
                                <div class="price-amount">{{ number_format($product['price'], 0, ',', '.') }} USDT</div>

                                @php
                                    $buttonState = '';
                                    $buttonText = '';
                                    $disabled = false;

                                    if (!$product['is_active']) {
                                        $buttonState = 'Brevemente';
                                    } elseif ($product->hasUser()) {
                                        $buttonState = 'Investindo';
                                    } else {
                                        $buttonState = 'Investir';
                                    }
                                @endphp

                                <button class="feed-button"
                                    @if (!$disabled) onclick="event.preventDefault(); document.getElementById('invest-form-{{ $product['id'] }}').submit();" @endif
                                    @disabled($disabled)>
                                    {{ $buttonState }}
                                </button>

                            </div>
                            <div class="stats-grid">
                                <div class="stat-item">
                                    <div class="stat-value">{{ number_format($product['income'], 0, ',', '.') }}</div>
                                    <div class="stat-label">Renda Diária</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">{{ $product['duration'] }}</div>
                                    <div class="stat-label">Duração</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-value">
                                        {{ number_format($product['income'] * $product['duration'], 0, ',', '.') }}</div>
                                    <div class="stat-label">Renda Total</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form id="invest-form-{{ $product['id'] }}" action="{{ route('client.invest', $product['id']) }}"
                        method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @endforeach
        </div>
    </div>
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

    .name-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }

    .name-amount {
        font-size: 1rem;
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
