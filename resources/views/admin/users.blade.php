@extends('layouts.admin.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Usúarios</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Entrar</a>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Usúarios</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Telefone</th>
                                <th>Status</th>
                                <th>Renda Diária</th>
                                <th>Saldo</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->tel }}</td>
                                    <td>{{ $user->is_active ? 'Activo' : 'Inactivo' }}</td>
                                    <td>{{ number_format($user->wallet->daily, 2, ',', '.') }} Kz</td>
                                    <td>{{ number_format($user->wallet->money, 2, ',', '.') }} Kz</td>
                                    <th>
                                        <a href="#">Visualizar</a>
                                    </th>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Nenhum usuário encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
