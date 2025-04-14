@extends('layouts.admin.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Presentes</h1>
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal"
                data-bs-target="#modal_create"><i class="fas fa-download fa-sm text-white-50"></i> Novo Presente</button>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Presentes</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Valor</th>
                                <th>Código</th>
                                <th>Estatus</th>
                                <th>Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($gifts as $gift)
                                <tr>
                                    <td style="text-align: center">{{ $gift->id }}</td>
                                    <td>{{ $gift->value }}</td>
                                    <td>{{ $gift->token }}</td>
                                    <td>{{ $gift->status }}</td>
                                    <td style="text-align: center">{{ $gift->user->id ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Nenhum presente encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade modal_create" id="modal_create" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <form method="POST" id="frm_create" class="form-horizontal form-label-left frm_create" action="{{ route('admin.gift.store') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel2">Criar Presente</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12 col-sm-12 col-xs-12 inputs">
                                <div class="form-group select-wrapper">
                                    <label class="control-label">Insira o Valor<span class="obrigatorio">*</span></label>
                                    <input type="text" id="value" name="value" class="form-control"
                                        placeholder="Valor">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var IndexRoute = '{{ route('admin.gift.index') }}';
    </script>
@endsection
