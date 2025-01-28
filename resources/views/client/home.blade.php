@extends('layouts.client.app')

@section('content')
    <div class="container mt-5 pt-4">
        <!-- Video Banner -->
        <div class="video-banner mb-4 p-4">
            <div class="row align-items-center">
                <div class="col-8">
                    <h2 class="text-white mb-0">LET'S TALK<br>VERIFICATION</h2>
                </div>
                <div class="col-4 text-end">
                    <i class="bi bi-play-circle fs-1"></i>
                </div>
            </div>
        </div>

        <!-- Market Movers -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Big Movers</h6>
                <i class="bi bi-three-dots-vertical"></i>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-4">
                        <div class="price-up">2.27%</div>
                        <small>ADA</small>
                    </div>
                    <div class="col-4">
                        <div class="price-up">1.49%</div>
                        <small>SOL</small>
                    </div>
                    <div class="col-4">
                        <div class="price-up">1.3%</div>
                        <small>BTC</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Watchlist -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">My Watchlist</h6>
                <div>
                    <i class="bi bi-filter me-2"></i>
                    <i class="bi bi-three-dots-vertical"></i>
                </div>
            </div>
            <div class="card-body p-0">
                <!-- Filter Pills -->
                <div class="p-3 border-bottom scroll-horizontal">
                    <div class="btn-group">
                        <button class="btn btn-dark btn-sm">All</button>
                        <button class="btn btn-light btn-sm">Crypto</button>
                        <button class="btn btn-light btn-sm">Stocks</button>
                        <button class="btn btn-light btn-sm">People</button>
                    </div>
                </div>

                <!-- Watchlist Items -->
                <div class="watchlist-item d-flex align-items-center p-3">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/etoro2.jpg-690dUocqVckfY2ahq1v2Y4tkFMRNsL.jpeg"
                        alt="BTC" class="asset-icon me-3">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <strong>BTC</strong>
                            <span class="price-up">+1.23%</span>
                        </div>
                        <div class="asset-price">$103,995.57</div>
                    </div>
                </div>

                <div class="watchlist-item d-flex align-items-center p-3">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/etoro2.jpg-690dUocqVckfY2ahq1v2Y4tkFMRNsL.jpeg"
                        alt="TSLA" class="asset-icon me-3">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <strong>TSLA</strong>
                            <span class="price-down">-2.43%</span>
                        </div>
                        <div class="asset-price">$397.45</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
