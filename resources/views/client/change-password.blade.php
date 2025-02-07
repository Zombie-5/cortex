@extends('layouts.client.app')

@section('content')
    <div class="container py-4" style="margin-top: 50px">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="background-color: var(--card-bg); color: var(--text-primary);">
                    <div class="card-header" style="background-color: var(--primary-green); color: white;">
                        <h4 class="mb-0">Troca de Senha</h4>
                    </div>
                    <div class="card-body">
                        <form id="changePasswordForm">
                            <div class="mb-3">
                                <label for="currentPassword" class="form-label">Senha atual</label>
                                <input type="password" class="form-control" id="currentPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">Nova senha</label>
                                <input type="password" class="form-control" id="newPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirmar nova senha</label>
                                <input type="password" class="form-control" id="confirmPassword" required>
                            </div>
                            <button type="submit" class="btn w-100"
                                style="background-color: var(--primary-green); color: white;">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('changePasswordForm');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const newPassword = document.getElementById('newPassword').value;
                const confirmPassword = document.getElementById('confirmPassword').value;

                if (newPassword !== confirmPassword) {
                    alert('A nova senha e a confirmação não coincidem.');
                    return;
                }

                // Aqui você pode adicionar a lógica para enviar os dados para o servidor
                alert('Senha alterada com sucesso!');
            });
        });
    </script>
@endsection
