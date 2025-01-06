@extends('layouts.auth.app')

@section('content')
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Criar Conta</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('auth.store') }}">
                                    @csrf
                                        <div class="form-floating mb-3">
                                            <input name='tel' class="form-control" id="inputTel" type="text"
                                                placeholder="(+244) 923 000 000" />
                                            <label for="inputTel">Telefone</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input name='password' class="form-control" id="inputPassword" type="password"
                                                placeholder="Password" />
                                            <label for="inputPassword">Crie a senha</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input name='convite' class="form-control" id="inputInvite" type="text"
                                                placeholder="2345" />
                                            <label for="inputInvite">Codigo de Convite</label>
                                        </div>

                                        <div class="mt-4 mb-0">
                                            <div class="d-grid">
                                                <button class="btn btn-primary btn-block" type="submit">Criar Conta</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="{{ route('auth.signIn') }}">Já tem uma conta? Entrar</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
