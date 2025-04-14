@extends('layouts.client.app')

@section('content')
    <div class="container py-4" style="margin-top: 50px">
        <!-- Stats Cards -->
        <div class="card bg-white shadow-sm mb-4">
            <div class="card-body">
                <div class="row text-center g-3">
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <span class="text-muted mb-2">Vips</span>
                            <span class="h3 mb-0">{{ $level1->where('is_vip', 1)->count() + $level2->where('is_vip', 1)->count() }}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <span class="text-muted mb-2">Total</span>
                            <span class="h3 mb-0">{{ $level1->count() + $level2->count() }}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <span class="text-muted mb-2">Renda</span>
                            <span class="h3 mb-0">20721.8</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <span class="text-muted mb-2">Retiradas</span>
                            <span class="h3 mb-0">49723</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Level Tabs Card -->
        <div class="card bg-white shadow-sm">
            <div class="card-body p-0">
                <!-- Tab Navigation -->
                <ul class="nav nav-tabs" id="levelTabs" role="tablist">
                    <li class="nav-item flex-1" role="presentation">
                        <button class="nav-link active w-100" id="nivel1-tab" data-bs-toggle="tab" data-bs-target="#nivel1"
                            type="button" role="tab">
                            Nível 1
                        </button>
                    </li>
                    <li class="nav-item flex-1" role="presentation">
                        <button class="nav-link w-100" id="nivel2-tab" data-bs-toggle="tab" data-bs-target="#nivel2"
                            type="button" role="tab">
                            Nível 2
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="levelTabsContent">
                    <div class="tab-pane fade show active" id="nivel1" role="tabpanel">
                        <div class="p-3">
                            <div class="d-flex align-items-center text-success mb-3">
                                <span class="text-muted">Total:</span>
                                <span class="ms-1 fw-medium">{{ $level1->count() }}</span>
                            </div>

                            <!-- Team Members List -->
                            <div class="team-members">
                                @forelse ($level1 as $member)
                                    <div class="d-flex align-items-center mb-3 p-2 rounded-3 member-item">
                                        <img src="https://m.media-amazon.com/images/I/51bgFEDvoNL.png"
                                            class="rounded-circle me-3"
                                            style="width: 40px; height: 40px; object-fit: cover;" alt="Member avatar">
                                        <div>
                                            <div class="fw-medium">{{ $member['tel'] }}</div>
                                            <div class="text-muted small">{{ $member['created_at'] }}</div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-3">
                                        <!-- Nível 2 content -->
                                        <div class="text-center text-muted py-5">
                                            Nenhum Convidado encontrado no Nível 1
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nivel2" role="tabpanel">
                        <div class="p-3">
                            <div class="d-flex align-items-center text-success mb-3">
                                <span class="text-muted">Total:</span>
                                <span class="ms-1 fw-medium">{{ $level2->count() }}</span>
                            </div>

                            <!-- Team Members List -->
                            <div class="team-members">
                                @forelse ($level2 as $member)
                                    <div class="d-flex align-items-center mb-3 p-2 rounded-3 member-item">
                                        <img src="https://m.media-amazon.com/images/I/51bgFEDvoNL.png"
                                            class="rounded-circle me-3"
                                            style="width: 40px; height: 40px; object-fit: cover;" alt="Member avatar">
                                        <div>
                                            <div class="fw-medium">{{ $member['tel'] }}</div>
                                            <div class="text-muted small">{{ $member['created_at'] }}</div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-3">
                                        <!-- Nível 2 content -->
                                        <div class="text-center text-muted py-5">
                                            Nenhum Convidado encontrado no Nível 2
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary-green: #1dc37a;
        }

        .nav-tabs {
            border-bottom: 1px solid #dee2e6;
        }

        .nav-tabs .nav-link {
            color: #666;
            border: none;
            border-bottom: 2px solid transparent;
            padding: 1rem 1.5rem;
            text-align: center;
        }

        .nav-tabs .nav-link:hover {
            border-color: transparent;
            isolation: isolate;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary-green);
            border-bottom: 2px solid var(--primary-green);
            font-weight: 500;
        }

        .team-members {
            max-height: 70vh;
            overflow-y: auto;
        }

        .member-item {
            transition: background-color 0.2s ease;
        }

        .member-item:hover {
            background-color: #f8f9fa;
        }

        /* Custom scrollbar for team members list */
        .team-members::-webkit-scrollbar {
            width: 6px;
        }

        .team-members::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .team-members::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        .team-members::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .flex-1 {
            flex: 1;
        }
    </style>
@endsection
