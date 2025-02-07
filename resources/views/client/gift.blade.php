@extends('layouts.client.app')

@section('content')
<div class="container py-4" style="margin-top: 50px">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card" style="background-color: var(--card-bg); color: var(--text-primary);">
                <div class="card-header" style="background-color: var(--primary-green); color: white;">
                    <h4 class="mb-0">Resgatar Presente</h4>
                </div>
                <div class="card-body">
                    <form id="redeemGiftForm">
                        <div class="mb-3">
                            <label for="giftCode" class="form-label">Código de Resgate</label>
                            <input type="text" class="form-control" id="giftCode" placeholder="Insira o código de resgate" required>
                        </div>
                        <button type="submit" class="btn w-100" style="background-color: var(--primary-green); color: white;">Resgatar</button>
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
    const form = document.getElementById('redeemGiftForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const giftCode = document.getElementById('giftCode').value;
        
        // Aqui você pode adicionar a lógica para enviar o código para o servidor
        alert('Código de resgate enviado: ' + giftCode);
    });
});
</script>
@endsection