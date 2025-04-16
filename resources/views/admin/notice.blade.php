@extends('layouts.admin.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Noticias</h1>
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal"
                data-bs-target="#modal_create"><i class="fas fa-download fa-sm text-white-50"></i> Nova Noticia</button>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Noticias</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Noticia</th>
                                <th>Visível</th>
                                <th>Remover</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($notices as $notice)
                                <tr>
                                    <td>{{ $notice->id }}</td>
                                    <td>{{ $notice->notice }}</td>
                                    <td data-bs-toggle="modal" data-bs-target="#modal_set_is_active"
                                        data-id="{{ Crypt::encryptString($notice->id) }}"
                                        data-is_active="{{ $notice->status }}"
                                        style="cursor: pointer;">
                                        {{ $notice->status ? 'Sim ' : 'Não ' }}
                                        <i class="fa fa-hand-pointer" aria-hidden="true"></i>
                                    </td>
                                    <th>
                                        <a href="#" data-id="{{ Crypt::encryptString($notice->id) }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modal_destroy">
                                            <i class="fa fa-trash"></i></a>
                                        </td>
                                    </th>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Nenhuma Noticia encontrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade modal_create" id="modal_create" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <form method="POST" id="frm_create" class="form-horizontal form-label-left frm_create"
                    action="{{ route('admin.notices.store') }}">

                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel2">Cadastro de Noticias</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 inputs">
                                    <div class="form-group select-wrapper">
                                        <label class="control-label">Nome da Noticia <span
                                                class="obrigatorio">*</span></label>
                                        <input type="text" id="notice" name="notice" class="form-control"
                                            placeholder="Nome da Noticia">
                                    </div>
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

        <div class="modal fade modal_destroy" id="modal_destroy" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <form method="POST" id="frm_destroy" class="form-horizontal form-label-left frm_destroy">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel2">Eliminar Noticia</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 inputs">
                                    <div class="form-group select-wrapper">
                                        <h5 id="msg"></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Eliminar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade modal_set_is_active" id="modal_set_is_active" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <form method="POST" id="frm_set_active" class="form-horizontal form-label-left frm_set_active">
                    @csrf
                    @method('PATCH')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel2">Editar Disponibilidade</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 inputs">
                                    <div class="form-group select-wrapper">
                                        <h5 id="msg"></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Confirmar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var IndexRoute = '{{ route('admin.notices.index') }}';

        $('#modal_destroy').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botão que acionou a modal
            var id = button.data('id'); // Pegando o id do servico

            $(this).find('#msg').html("Deseja realmente eliminar está noticia ?");

            var actionUrl = "{{ route('admin.notices.destroy', ':id') }}";
            actionUrl = actionUrl.replace(':id', id);
            $(this).find('#frm_destroy').attr('action', actionUrl);
        });

        $('#modal_set_is_active').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botão que acionou a modal
            var id = button.data('id'); // Pegando o id do servico
            var is_active = button.data('is_active'); // Pegando o nome

            if (is_active) {
                $(this).find('#msg').html("Deseja realmente ocultar está noticia?");
            } else {
                $(this).find('#msg').html("Deseja realmente divulgar está noticia?");
            }

            var actionUrl = "{{ route('admin.notices.active', ':id') }}";
            actionUrl = actionUrl.replace(':id', id);
            $(this).find('#frm_set_active').attr('action', actionUrl);
        });
    </script>
    {{-- <script src="{{ asset('assets/js/private/form-validate/product.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/private/persistence/save.js') }}"></script> --}}
    <script src="{{ asset('assets/js/private/persistence/edit.js') }}"></script>
    <script src="{{ asset('assets/js/private/persistence/destroy.js') }}"></script>
@endsection
