@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Liquido</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Kz {{ number_format($found->liquid, 2, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Depósitos</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Kz {{ number_format($totalDeposited, 2, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Retiradas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Kz {{ number_format($totalWithdrawn, 2, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Saldo</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Kz {{ number_format($found->balance, 2, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Utilizadores</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">VIP
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalVipUsers }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-crown fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Produtos</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProducts }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Vendidos</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProductsSold }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-star fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-7 col-lg-8">
                <div class="card shadow mb-4">
                    <!-- Cabeçalho do Cartão -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Desempenho de Depósitos e Retiradas</h6>
                    </div>
                    <!-- Corpo do Cartão -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="depositInvestmentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top 10 Usuários -->
<div class="col-xl-5 col-lg-4">
    <div class="card shadow mb-4 pb-2">
        <!-- Cabeçalho do Card -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Top 5 Melhores Utilizadores</h6>
        </div>
        <!-- Corpo do Card -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Produtos</th>
                            <th>VIP</th>
                            <th>Renda</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Dados do gráfico
        var ctx = document.getElementById("depositInvestmentChart").getContext('2d');
        var depositInvestmentChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Semana 1", "Semana 2", "Semana 3", "Semana 4", "Semana 5", "Semana 6"],
                datasets: [{
                        label: "Depósitos",
                        data: [0, 500, 600, 400, 700, 900],
                        backgroundColor: "rgba(28, 200, 138, 0.2)",
                        borderColor: "rgba(28, 200, 138, 1)",
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label: "Retiradas",
                        data: [0, 700, 400, 900, 1200, 800],
                        backgroundColor: "rgba(220, 53, 69, 0.2)",
                        borderColor: "rgba(220, 53, 69, 1)",
                        borderWidth: 2,
                        fill: false
                    },
                    {
                        label: "Saldo",
                        data: [600, 800, 700, 1100, 1400, 1000], // Exemplo de saldo acumulado
                        backgroundColor: "rgba(255, 193, 7, 0.2)", // Amarelo
                        borderColor: "rgba(255, 193, 7, 1)",
                        borderWidth: 2,
                        fill: false
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: "Semanas"
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: "Quantia (Kz)"
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
