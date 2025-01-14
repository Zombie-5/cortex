@extends('layouts.admin.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Produtos</h1>
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal"
                data-bs-target="#modal_create"><i class="fas fa-download fa-sm text-white-50"></i> Novo Produto</button>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Produtos</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Renda Diária</th>
                                <th>Duração</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ number_format($product->price, 2, ',', '.') }} Kz</td>
                                    <td>{{ number_format($product->income, 2, ',', '.') }} Kz</td>
                                    <td>{{ $product->duration }} dias</td>
                                    <th>
                                        <a href="#" class="mx-2"><i class="fas fa-eye"></i></a>
                                        <button type="button" class="mr-3 b-none" data-bs-toggle="modal"
                                            data-bs-target="#modal_edit_{{ $product->id }}">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <a href="#" data-id="{{ Crypt::encryptString($product->id) }}"
                                            data-name="{{ $product->name }}" data-bs-toggle="modal"
                                            data-bs-target="#modal_destroy">
                                            <i class="fa fa-trash"></i></a>
                                        </td>
                                    </th>
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

        <div class="modal fade modal_create" id="modal_create" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <form method="POST" id="frm_create" class="form-horizontal form-label-left frm_create"
                    action="{{ route('admin.product.store') }}">

                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel2">Cadastro de Produtos</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 inputs">
                                    <div class="form-group select-wrapper">
                                        <label class="control-label">Nome do Produto <span
                                                class="obrigatorio">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="Nome do Produto">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 inputs">
                                    <div class="form-group select-wrapper">
                                        <label class="control-label">Descrição do Produto <span
                                                class="obrigatorio">*</span></label>
                                        <input type="text" id="desc" name="desc" class="form-control"
                                            placeholder="Descrição do Produto">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12 inputs">
                                    <div class="form-group select-wrapper">
                                        <label class="control-label">Preço<span class="obrigatorio">*</span></label>
                                        <input type="text" id="price" name="price" class="form-control"
                                            placeholder="Preço">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 inputs">
                                    <div class="form-group select-wrapper">
                                        <label class="control-label">Renda Diária<span class="obrigatorio">*</span></label>
                                        <input type="text" id="income" name="income" class="form-control"
                                            placeholder="Renda Diária">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 inputs">
                                    <div class="form-group select-wrapper">
                                        <label class="control-label">Duração<span class="obrigatorio">*</span></label>
                                        <input type="text" id="duration" name="duration" class="form-control"
                                            placeholder="Duração">
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

        @foreach ($products as $product)
            <div class="modal fade" id="modal_edit_{{ $product->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <form method="POST" action="{{ route('admin.product.update', $product->id) }}">
                        @csrf
                        @method('PUT') <!-- Necessário para chamadas PUT -->

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Produto: {{ $product->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 inputs">
                                        <div class="form-group select-wrapper">
                                            <label class="control-label">Nome do Produto <span
                                                    class="obrigatorio">*</span></label>
                                            <input type="text" id="name_{{ $product->id }}" name="name"
                                                class="form-control" value="{{ $product->name }}"
                                                placeholder="Nome do Produto" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 inputs">
                                        <div class="form-group select-wrapper">
                                            <label class="control-label">Descrição do Produto <span
                                                    class="obrigatorio">*</span></label>
                                            <input type="text" id="desc_{{ $product->id }}" name="desc"
                                                class="form-control" value="{{ $product->desc }}"
                                                placeholder="Descrição do Produto" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12 inputs">
                                        <div class="form-group select-wrapper">
                                            <label class="control-label">Preço <span class="obrigatorio">*</span></label>
                                            <input type="text" id="price_{{ $product->id }}" name="price"
                                                class="form-control" value="{{ $product->price }}" placeholder="Preço"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12 inputs">
                                        <div class="form-group select-wrapper">
                                            <label class="control-label">Renda Diária <span
                                                    class="obrigatorio">*</span></label>
                                            <input type="text" id="income_{{ $product->id }}" name="income"
                                                class="form-control" value="{{ $product->income }}"
                                                placeholder="Renda Diária" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 inputs">
                                        <div class="form-group select-wrapper">
                                            <label class="control-label">Duração <span
                                                    class="obrigatorio">*</span></label>
                                            <input type="text" id="duration_{{ $product->id }}" name="duration"
                                                class="form-control" value="{{ $product->duration }}"
                                                placeholder="Duração" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach


        <div class="modal fade modal_destroy" id="modal_destroy" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <form method="POST" id="frm_destroy" class="form-horizontal form-label-left frm_destroy">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel2">Eliminar Produto</h4>
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
        var IndexRoute = '{{ route('admin.product.index') }}';

        $('#modal_destroy').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Botão que acionou a modal
            var id = button.data('id'); // Pegando o id do servico
            var name = button.data('name'); // Pegando o nome

            $(this).find('#msg').html("Deseja realmente eliminar o produto '" + name + "'?");

            var actionUrl = "{{ route('admin.product.destroy', ':id') }}";
            actionUrl = actionUrl.replace(':id', id);
            $(this).find('#frm_destroy').attr('action', actionUrl);
        });
    </script>
    <script src="{{ asset('assets/js/private/form-validate/product.js') }}"></script>
    <script src="{{ asset('assets/js/private/persistence/save.js') }}"></script>
    <script src="{{ asset('assets/js/private/persistence/edit.js') }}"></script>
    <script src="{{ asset('assets/js/private/persistence/destroy.js') }}"></script>
@endsection
