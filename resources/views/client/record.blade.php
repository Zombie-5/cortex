@extends('layouts.client.app')

@section('content')
    <div class="container py-4" style="margin-top: 50px">
        <!-- Records List -->
        <div class="card bg-white shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">Registro retiradas</h5>

                <div class="records-list">
                    <!-- Example records -->
                    @php
                        $records = [
                            ['amount' => '1830.00', 'date' => '2023-12-14 17:46:52', 'status' => 'Esperando'],
                            ['amount' => '4273.00', 'date' => '2023-12-11 17:01:04', 'status' => 'Sucesso'],
                            ['amount' => '1795.00', 'date' => '2023-12-06 17:26:09', 'status' => 'Sucesso'],
                            ['amount' => '4078.00', 'date' => '2023-12-05 17:18:39', 'status' => 'Sucesso'],
                            ['amount' => '1892.00', 'date' => '2023-12-04 11:24:46', 'status' => 'Sucesso'],
                        ];
                    @endphp

                    @foreach ($records as $record)
                        <div class="record-item">
                            <div class="d-flex justify-content-between align-items-start border-bottom py-3">
                                <div>
                                    <div class="h5 mb-1">{{ number_format((float) $record['amount'], 2, '.', '') }}</div>
                                    <div class="text-muted small">{{ $record['date'] }}</div>
                                </div>
                                <div>
                                    <span
                                        class="status-badge {{ $record['status'] === 'Esperando' ? 'waiting' : 'success' }}">
                                        {{ $record['status'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Empty State (shown when no records) -->
                @if (count($records) === 0)
                    <div class="text-center text-muted py-5">
                        <p>Nenhum registro encontrado</p>
                    </div>
                @endif
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
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-badge.waiting {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-badge.success {
            background-color: #d4edda;
            color: #155724;
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
