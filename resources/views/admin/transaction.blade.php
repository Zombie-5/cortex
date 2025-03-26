@extends('layouts.admin.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row">
            <div
                class="col-md-12 nav-link-wrap pb-md-5 pb-sm-1 ftco-animate d-sm-flex align-items-center justify-content-between">

                <h1 class="h3 mb-0 text-gray-800">Transações</h1>

                <div class="nav ftco-animate nav-pills justify-content-end text-center" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">

                    <a class="nav-link active" id="v-pills-deposit-tab" data-toggle="pill" href="#v-pills-deposit"
                        role="tab" aria-controls="v-pills-deposit" aria-selected="true">Depositos</a>

                    <a class="nav-link" id="v-pills-performance-tab" data-toggle="pill" href="#v-pills-performance"
                        role="tab" aria-controls="v-pills-performance" aria-selected="false">Retiradas</a>

                    <a class="nav-link" id="v-pills-perfo-tab" data-toggle="pill" href="#v-pills-perfo"
                        role="tab" aria-controls="v-pills-perfo" aria-selected="false">Histórico</a>

                </div>
            </div>

            <div class="col-md-12 align-items-center ftco-animate">

                <div class="tab-content ftco-animate" id="v-pills-tabContent">
                    <!--listagem de emails-->
                    <div class="tab-pane fade show active" id="v-pills-deposit" role="tabpanel"
                        aria-labelledby="v-pills-deposit-tab">
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Lista de Depositos</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Banco</th>
                                                <th>Iban</th>
                                                <th>Acção</th>
                                                <th>Valor</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transactionsDeposited as $transaction)
                                                <tr>
                                                    <td style="text-align: center">{{ $transaction->user->id }}</td>
                                                    <td>{{ $transaction->user->bank->name }}</td>
                                                    <td>{{ $transaction->user->bank->iban }}</td>
                                                    <td>{{ $transaction->type }}</td>
                                                    <td>{{ number_format($transaction->value, 2, ',', '.') }} Kz</td>
                                                    <td>
                                                        <form action="{{ route('admin.transaction.status', $transaction->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <select name="status" onchange="this.form.submit()"
                                                                class="select @if ($transaction->status == 'pendente') status-pendente @elseif ($transaction->status == 'processando') status-processando @elseif ($transaction->status == 'concluido') status-concluido @elseif ($transaction->status == 'rejeitado') status-rejeitado @endif">
                                                                <option value="pendente"
                                                                    {{ $transaction->status == 'pendente' ? 'selected' : '' }}>
                                                                    Pendente</option>
                                                                <option value="processando"
                                                                    {{ $transaction->status == 'processando' ? 'selected' : '' }}>
                                                                    Processando
                                                                </option>
                                                                <option value="concluido"
                                                                    {{ $transaction->status == 'concluido' ? 'selected' : '' }}>Aprovado
                                                                </option>
                                                                <option value="rejeitado"
                                                                    {{ $transaction->status == 'rejeitado' ? 'selected' : '' }}>Rejeitado
                                                                </option>
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
                    </div>

                    <!--listagem de alojamento-->
                    <div class="tab-pane fade" id="v-pills-performance" role="tabpanel"
                        aria-labelledby="v-pills-performance-tab">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Lista de Retiradas</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Banco</th>
                                                <th>Iban</th>
                                                <th>Acção</th>
                                                <th>Valor</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transactionsWithdrawn as $transaction)
                                                <tr>
                                                    <td style="text-align: center">{{ $transaction->user->id }}</td>
                                                    <td>{{ $transaction->user->bank->name }}</td>
                                                    <td>{{ $transaction->user->bank->iban }}</td>
                                                    <td>{{ $transaction->type }}</td>
                                                    <td>{{ number_format($transaction->value, 2, ',', '.') }} Kz</td>
                                                    <td>
                                                        <form action="{{ route('admin.transaction.status', $transaction->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <select name="status" onchange="this.form.submit()"
                                                                class="select @if ($transaction->status == 'pendente') status-pendente @elseif ($transaction->status == 'processando') status-processando @elseif ($transaction->status == 'concluido') status-concluido @elseif ($transaction->status == 'rejeitado') status-rejeitado @endif">
                                                                <option value="pendente"
                                                                    {{ $transaction->status == 'pendente' ? 'selected' : '' }}>
                                                                    Pendente</option>
                                                                <option value="processando"
                                                                    {{ $transaction->status == 'processando' ? 'selected' : '' }}>
                                                                    Processando
                                                                </option>
                                                                <option value="concluido"
                                                                    {{ $transaction->status == 'concluido' ? 'selected' : '' }}>Aprovado
                                                                </option>
                                                                <option value="rejeitado"
                                                                    {{ $transaction->status == 'rejeitado' ? 'selected' : '' }}>Rejeitado
                                                                </option>
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
                    </div>

                    <div class="tab-pane fade" id="v-pills-perfo" role="tabpanel"
                        aria-labelledby="v-pills-performance-tab">
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
                                                <th>Acção</th>
                                                <th>Valor</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transactions as $transaction)
                                                <tr>
                                                    <td style="text-align: center">{{ $transaction->user->id }}</td>
                                                    <td>{{ $transaction->user->bank->name }}</td>
                                                    <td>{{ $transaction->user->bank->iban }}</td>
                                                    <td>{{ $transaction->type }}</td>
                                                    <td>{{ number_format($transaction->value, 2, ',', '.') }} Kz</td>
                                                    <td>
                                                        <form action="{{ route('admin.transaction.status', $transaction->id) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <select name="status" onchange="this.form.submit()"
                                                                class="select @if ($transaction->status == 'pendente') status-pendente @elseif ($transaction->status == 'processando') status-processando @elseif ($transaction->status == 'concluido') status-concluido @elseif ($transaction->status == 'rejeitado') status-rejeitado @endif">
                                                                <option value="pendente"
                                                                    {{ $transaction->status == 'pendente' ? 'selected' : '' }}>
                                                                    Pendente</option>
                                                                <option value="processando"
                                                                    {{ $transaction->status == 'processando' ? 'selected' : '' }}>
                                                                    Processando
                                                                </option>
                                                                <option value="concluido"
                                                                    {{ $transaction->status == 'concluido' ? 'selected' : '' }}>Aprovado
                                                                </option>
                                                                <option value="rejeitado"
                                                                    {{ $transaction->status == 'rejeitado' ? 'selected' : '' }}>Rejeitado
                                                                </option>
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
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

<style>
    /* Define as cores para cada status */
    .status-pendente {
        color: gray;
    }

    .status-processando {
        color: orange;
    }

    .status-concluido {
        color: green;
    }

    .status-rejeitado {
        color: red;
    }

    /* Remove a borda ao clicar */
    select {
        border: none;
        outline: none;
        box-shadow: none;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }
</style>
