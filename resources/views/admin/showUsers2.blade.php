@extends('layouts.admin.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Informações Básicas -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user"></i> Informações Básicas</h6>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><strong>Nome:</strong> João da Silva</li>
                            <li><strong>Telefone:</strong> (11) 99999-9999</li>
                            <li><strong>Número de subordinados:</strong> 12</li>
                            <li><strong>Número de subordinados VIP:</strong> 3</li>
                            <li><strong>Tipo de usuário:</strong> 
                                <ul>
                                    <li><strong>Admin:</strong> <span class="badge badge-success">Sim</span></li>
                                    <li><strong>VIP:</strong> <span class="badge badge-danger">Não</span></li>
                                    <li><strong>Ativo:</strong> <span class="badge badge-success">Sim</span></li>
                                </ul>
                            </li>
                            <li><strong>ID do usuário:</strong> 42</li>
                            <li><strong>Criado por:</strong> Maria Oliveira</li>
                            <li><strong>Gerente:</strong> Carlos Souza</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Carteira -->
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-wallet"></i> Carteira</h6>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><strong>Dinheiro disponível:</strong> R$ 1.200,00</li>
                            <li><strong>Lucro do dia:</strong> R$ 50,00</li>
                            <li><strong>Lucro diário médio:</strong> R$ 42,00</li>
                            <li><strong>Lucro total:</strong> R$ 8.900,00</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Conta Bancária -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-bank"></i> Conta Bancária</h6>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><strong>Banco:</strong> Banco XPTO</li>
                            <li><strong>Titular:</strong> João da Silva</li>
                            <li><strong>IBAN:</strong> BR00 XPTO 1234 5678 0000 0001</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produtos Comprados -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cogs"></i> Produtos Comprados</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Preço de Compra</th>
                                    <th>Rendimento Diário</th>
                                    <th>Total Arrecadado</th>
                                    <th>Última Coleta</th>
                                    <th>Expira Em</th>
                                    <th>Duração do Investimento</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Produto 1</td>
                                    <td>Descrição do Produto 1</td>
                                    <td>R$ 500,00</td>
                                    <td>R$ 50,00</td>
                                    <td>R$ 200,00</td>
                                    <td>2025-04-09</td>
                                    <td>2025-06-09</td>
                                    <td>60 dias</td>
                                </tr>
                                <tr>
                                    <td>Produto 2</td>
                                    <td>Descrição do Produto 2</td>
                                    <td>R$ 1.000,00</td>
                                    <td>R$ 100,00</td>
                                    <td>R$ 500,00</td>
                                    <td>2025-04-10</td>
                                    <td>2025-08-10</td>
                                    <td>120 dias</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transações -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-exchange-alt"></i> Transações</h6>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><strong>Total depositado:</strong> R$ 5.000,00</li>
                            <li><strong>Total retirado:</strong> R$ 2.300,00</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gift Codes Resgatados -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-gift"></i> Gift Codes Resgatados</h6>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><strong>Total resgatado:</strong> R$ 300,00</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End Page Content -->
@endsection
