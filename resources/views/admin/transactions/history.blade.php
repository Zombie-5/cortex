@extends('admin.transactions.transaction')

@section('transaction_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Histórico</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Banco</th>
                            <th>Iban</th>
                            <th>Ação</th>
                            <th>Valor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td style="text-align: center">{{ $transaction->user->id }}</td>
                                <td>{{ $transaction->user->bank->name ?? 'Indefinido' }}</td>
                                <td>{{ $transaction->user->bank->iban ?? 'Indefinido' }}</td>
                                <td>{{ $transaction->type }}</td>
                                <td>{{ number_format($transaction->value, 2, ',', '.') }} Kz</td>
                                <td>
                                    <form action="{{ route('admin.transaction.status', $transaction->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                            class="select @if ($transaction->status == 'pendente') status-pendente @elseif ($transaction->status == 'processando') status-processando @elseif ($transaction->status == 'concluido') status-concluido @elseif ($transaction->status == 'rejeitado') status-rejeitado @endif">
                                            <option value="pendente" {{ $transaction->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                                            <option value="processando" {{ $transaction->status == 'processando' ? 'selected' : '' }}>Processando</option>
                                            <option value="concluido" {{ $transaction->status == 'concluido' ? 'selected' : '' }}>Aprovado</option>
                                            <option value="rejeitado" {{ $transaction->status == 'rejeitado' ? 'selected' : '' }}>Rejeitado</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Nenhuma Transação encontrada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection