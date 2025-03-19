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
                    <form action="{{ route('client.gift.redeem') }}" method="POST" id="redeemGiftForm">
                        @csrf
                        <div class="mb-3">
                            <label for="giftCode" class="form-label">Código de Resgate</label>
                            <input type="text" class="form-control" name="token" placeholder="Insira o código de resgate" required>
                        </div>
                        <button type="submit" class="btn w-100" style="background-color: var(--primary-green); color: white;">Resgatar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection