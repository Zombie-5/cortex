@extends('layouts.admin.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 600px;">
        <h4 class="mb-4 text-center text-primary">Gerenciar Links Úteis</h4>

        <form action="{{ route('admin.link.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="link_manager">Link do Gerente</label>
                <input type="url" class="form-control" id="link_manager" name="link_manager"
                    value="{{ old('link_manager', $links->link_manager ?? '') }}" placeholder="https://exemplo.com">
            </div>

            <div class="form-group mt-3">
                <label for="link_customer_service">Atendimento ao Cliente</label>
                <input type="url" class="form-control" id="link_customer_service" name="link_customer_service"
                    value="{{ old('link_customer_service', $links->link_customer_service ?? '') }}" placeholder="https://exemplo.com">
            </div>

            <div class="form-group mt-3">
                <label for="link_group">Link do Grupo</label>
                <input type="url" class="form-control" id="link_group" name="link_group"
                    value="{{ old('link_group', $links->link_group ?? '') }}" placeholder="https://exemplo.com">
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success px-4">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection
