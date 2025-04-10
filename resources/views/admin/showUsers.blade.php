@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perfil do Usuário</h1>
    </div>

    <div class="row">
        <!-- Informações Básicas -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user fa-fw"></i> Informações Básicas</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">ID do usuário:</div>
                        <div class="col-md-8">{{$user->id}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Nome:</div>
                        <div class="col-md-8">{{$user->bank->owner ?? "Fulano"}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Telefone:</div>
                        <div class="col-md-8">{{$user->tel}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Tipo de usuário:</div>
                        <div class="col-md-8">
                            @if ($user->is_vip)
                                <span class="badge badge-danger">Beta</span>
                            @else
                                <span class="badge badge-success">VIP</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Produtos:</div>
                        <div class="col-md-8">{{$user->products->count()}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Subordinados:</div>
                        <div class="col-md-8">{{$user->subordinates->count()}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Subordinados VIP:</div>
                        <div class="col-md-8">{{$user->subordinatesVip->count()}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">ID do Superior:</div>
                        <div class="col-md-8">{{$user->superior->id}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Gerente:</div>
                        <div class="col-md-8">{{$user->manager->name}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Criado em:</div>
                        <div class="col-md-8">{{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}</div>
                    </div>
                    <br>
                </div>
            </div>
        </div>

        <!-- Carteira -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-wallet fa-fw"></i> Carteira</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6 font-weight-bold">Dinheiro disponível:</div>
                        <div class="col-md-6 text-success">{{ number_format($user->wallet->money, 2, ',', '.') }} Kz</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 font-weight-bold">Renda diária:</div>
                        <div class="col-md-6 text-success">{{ number_format($user->wallet->daily, 2, ',', '.') }} Kz</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 font-weight-bold">Renda de hoje:</div>
                        <div class="col-md-6 text-success">{{ number_format($user->wallet->today, 2, ',', '.') }} Kz</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 font-weight-bold">Renda total:</div>
                        <div class="col-md-6 text-success">{{ number_format($user->wallet->total, 2, ',', '.') }} Kz</div>
                    </div>
                </div>
            </div>

            <!-- Conta Bancária -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-university fa-fw"></i> Conta Bancária</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Banco:</div>
                        <div class="col-md-8">{{$user->bank->name ?? "Não definido"}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">Titular:</div>
                        <div class="col-md-8">{{$user->bank->owner ?? "Não definido"}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 font-weight-bold">IBAN:</div>
                        <div class="col-md-8">{{ $user->bank->iban ? chunk_split($user->bank->iban, 4, ' ') : 'Não definido' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row align-items-stretch">
        <!-- Transações -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-exchange-alt fa-fw"></i> Transações</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6 font-weight-bold">Total depositado:</div>
                        <div class="col-md-6 text-success">{{ number_format($totalDepositado, 2, ',', '.') }} Kz</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 font-weight-bold">Total retirado:</div>
                        <div class="col-md-6 text-danger">{{ number_format($totalRetirado, 2, ',', '.') }} Kz</div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Gift codes -->
        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-gift fa-fw"></i> Presentes</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6 font-weight-bold">Presentes resgatados:</div>
                        <div class="col-md-6 text-success">{{$presentesResgatados}}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6 font-weight-bold">Total resgatado:</div>
                        <div class="col-md-6 text-success">{{ number_format($totalResgatado, 2, ',', '.') }} Kz</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Produtos comprados -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-box fa-fw"></i> Produtos comprados</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nome do produto</th>
                            <th>Preço de compra</th>
                            <th>Rendimento diário</th>
                            <th>Total arrecadado</th>
                            <th>Última coleta</th>
                            <th>Expira em</th>
                            <th>Duração total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user->products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ number_format($product->price, 2, ',', '.') }} Kz</td>
                                    <td>{{ number_format($product->income, 2, ',', '.') }} Kz</td>

                                    <td>{{ number_format($product->pivot->income_total, 2, ',', '.') }} Kz</td>
                                    <td>{{ \Carbon\Carbon::parse($product->pivot->last_collection)->format('d M, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($product->pivot->expires_at)->format('d M, Y') }}</td>
                                    <td>{{ $product->duration }} dias</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Nenhum produto encontrado.</td>
                                </tr>
                            @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection