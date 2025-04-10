@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bancos</h1>
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal"
                data-bs-target="#modal_create"><i class="fas fa-download fa-sm text-white-50"></i> Novo Banco</button>
        </div>

        <div class="col-md-12 align-items-center ftco-animate">
            <div class="tab-content ftco-animate" id="v-pills-tabContent">
                <!--listagem de alojamento-->
                <div class="tab-pane fade show active" id="v-pills-performance" role="tabpanel"
                    aria-labelledby="v-pills-performance-tab">
                    <div class="row d-flex">
                        @forelse ($banks as $bank)
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">{{ $bank->name }}</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Opções:</div>
                                            
                                            <a class="dropdown-item" href="#" 
                                                data-id="{{ Crypt::encryptString($bank->id) }}"
                                                data-name="{{ $bank->name }}" 
                                                data-owner="{{ $bank->owner }}"
                                                data-iban="{{ $bank->iban }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal_edit">Editar</a>
                                            
                                            <a class="dropdown-item" href="#"
                                                data-id="{{ Crypt::encryptString($bank->id) }}"
                                                data-name="{{ $bank->name }}" data-bs-toggle="modal"
                                                data-bs-target="#modal_destroy">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <p><strong>Proprietario: </strong>{{ $bank->owner }}</p>
                                    <p><strong>Iban: </strong>{{ chunk_split($bank->iban, 4, ' ') }}</p>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6">Nenhum Banco encontrado.</td>
                            </tr>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal_create" id="modal_create" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <form method="POST" id="frm_create" class="form-horizontal form-label-left frm_create"
                    action="{{ route('admin.bank.store') }}">

                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel2">Cadastrar Banco</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 inputs">
                                    <div class="form-group select-wrapper">
                                        <label class="control-label">Nome do Banco<span class="obrigatorio">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="Nome do Banco">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 inputs">
                                    <div class="form-group select-wrapper">
                                        <label class="control-label">Nome do Proprietario<span
                                                class="obrigatorio">*</span></label>
                                        <input type="text" id="owner" name="owner" class="form-control"
                                            placeholder="Nome do Proprietario">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 inputs">
                                    <div class="form-group select-wrapper">
                                        <label class="control-label">Iban<span class="obrigatorio">*</span></label>
                                        <input type="text" id="iban" name="iban" class="form-control"
                                            placeholder="Iban da conta">
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

        <div class="modal fade modal_edit" id="modal_edit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <form method="POST" id="frm_edit" class="form-horizontal form-label-left frm_edit">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel2">Editar Banco</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 inputs">
                                    <div class="form-group select-wrapper">
                                        <label class="control-label">Nome do Banco<span class="obrigatorio">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="Nome do Banco">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 inputs">
                                    <div class="form-group select-wrapper">
                                        <label class="control-label">Nome do Proprietario<span
                                                class="obrigatorio">*</span></label>
                                        <input type="text" id="owner" name="owner" class="form-control"
                                            placeholder="Nome do Proprietario">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 inputs">
                                    <div class="form-group select-wrapper">
                                        <label class="control-label">Iban<span class="obrigatorio">*</span></label>
                                        <input type="text" id="iban" name="iban" class="form-control"
                                            placeholder="Iban da conta">
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
                            <h4 class="modal-title" id="myModalLabel2">Eliminar Banco</h4>
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
    </div>
@endsection

@section('script')
    <script>
        var IndexRoute = '{{ route('admin.bank.index') }}';

        $('#modal_edit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botão que acionou a modal
            var id = button.data('id');
            var name = button.data('name'); // Pegando o nome
            var owner = button.data('owner'); // Pegando a duração
            var iban = button.data('iban'); // Pegando a duração
           
            // Preenchendo os campos da modal com os dados
            $(this).find('#name').val(name);
            $(this).find('#owner').val(owner);
            $(this).find('#iban').val(iban);

            var actionUrl = "{{ route('admin.bank.update', ':id') }}";
            actionUrl = actionUrl.replace(':id', id);
            $(this).find('#frm_edit').attr('action', actionUrl);
        });

        $('#modal_destroy').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botão que acionou a modal
            var id = button.data('id'); // Pegando o id do servico
            var name = button.data('name'); // Pegando o nome

            $(this).find('#msg').html("Deseja Realmente eliminar o Banco '" + name + "'?");

            var actionUrl = "{{ route('admin.bank.destroy', ':id') }}";
            actionUrl = actionUrl.replace(':id', id);
            $(this).find('#frm_destroy').attr('action', actionUrl);
        });
    </script>
    <script src="{{ asset('assets/js/private/form-validate/product.js') }}"></script>
    <script src="{{ asset('assets/js/private/persistence/save.js') }}"></script>
    <script src="{{ asset('assets/js/private/persistence/edit.js') }}"></script>
    <script src="{{ asset('assets/js/private/persistence/destroy.js') }}"></script>
@endsection
