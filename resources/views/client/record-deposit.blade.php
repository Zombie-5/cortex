@extends('layouts.client.app')

@section('content')
    <div class="container py-4" style="margin-top: 50px">
        <!-- Records List -->
        <div class="card bg-white shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Registros de Depositos</h5>

                <div class="records-list">
                    @forelse ($records as $record)
                        <div class="record-item">
                            <div class="d-flex justify-content-between align-items-start border-bottom py-3">
                                <div>
                                    <div class="h5 mb-1">{{ number_format((float) $record['value'], 2, '.', '') }} Kz</div>
                                    <div class="text-muted small">{{ $record['created_at'] }}</div>
                                </div>
                                <div>
                                    <span
                                        class="status-badge 
                                        @if ($record['status'] === 'pendente') waiting 
                                        @elseif($record['status'] === 'processando') processing
                                        @elseif($record['status'] === 'concluido') success
                                        @elseif($record['status'] === 'rejeitado') rejected @endif">
                                        {{ $record['status'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-5">
                            <p>Nenhum registro encontrado</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary-green: #1dc37a;
        }

        .records-list {
            max-height: 80vh;
            overflow-y: auto;
        }

        .record-item:last-child .d-flex {
            border-bottom: none !important;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-badge.processing {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-badge.waiting {
            background-color: #cce5ff;
            color: #6c757d;
        }

        .status-badge.success {
            background-color: #d4edda;
            color: #155724;
        }

        .status-badge.rejected {
            background-color: #f8d7da;
            color: #721c24;
        }


        /* Custom scrollbar */
        .records-list::-webkit-scrollbar {
            width: 6px;
        }

        .records-list::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .records-list::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        .records-list::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .card-title {
            color: var(--primary-green);
            font-weight: 500;
        }

        .h5 {
            font-weight: 500;
        }
    </style>
@endsection
