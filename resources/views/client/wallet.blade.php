@extends('layouts.client.app')

@section('content')
    <div class="container mt-5 pt-4">
        <!-- Portfolio Section -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4">Your Total Value</h5>
                <h2 class="mb-3">$0.00</h2>
                <small class="text-muted">Last update at 09:23, 28/01/2025</small>

                <hr>

                <h6 class="mb-3">Investment Account</h6>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <i class="bi bi-wallet2 text-success me-2"></i>
                        Portfolio
                    </div>
                    <strong>$0.00</strong>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>Available cash</div>
                    <span>$0.00</span>
                </div>

                <button class="btn btn-add-funds w-100 mb-3">Add Funds</button>
                <button class="btn btn-outline-success w-100">
                    Transfer
                    <i class="bi bi-plus-lg ms-2"></i>
                </button>
            </div>
        </div>
    </div>
@endsection
