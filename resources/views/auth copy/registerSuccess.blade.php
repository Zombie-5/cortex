<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dev-bantu Host - Criar Conta</title>

    <link rel="stylesheet" href="{{ asset('assets/auth/assets/css/bootstrap.css') }}">
    <link rel="shortcut icon"  type="image/x-icon" href="{{ asset('assets/img/devbantu/devbantu_32x32/devbantu_32x32.png')}}">
    <link rel="stylesheet" href="{{ asset('assets/auth/assets/css/app.css') }}">
    
    <style>
        label.error{
            color: red;
        }

        .error:focus{
            outline: none;
            border: 5px solid red;
        }

        .bg-orange {
            background-color: #fd7e14;
            color: white; /* Cor do texto */
        }
        .btn-orange {
            background-color: #fd7e14;
            color: white; /* Cor do texto */
            border: none
        }

        .bg-dark2{
            background-color: #506566;
            color: white;
        }

        #auth{
            background-image: url('{{ asset('assets/img/devbantu/bg2.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }

        .input:focus{
            outline: none;
            border: 2px solid #fd7e14;
        }

    </style>
</head>

<body>
    <div id="auth" >
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <a href="{{ route('/') }}"><img src="{{ asset('assets/img/devbantu/devbantu_164x42/devbantu_164x42.png') }}"  class='mb-4' /></a>
                                <h3>Verifique A Sua Caixa De E-mail</h3>
                                <p class="text-muted">
                                    Enviamos um link de verificação para o seu e-mail. Por favor, verifique sua caixa de entrada e siga as instruções.
                                </p>
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        Um novo link de verificação foi enviado para o seu e-mail.
                                    </div>
                                @endif
                                <p class="text-muted">
                                    Caso não tenha recebido o e-mail, você pode solicitar um novo link clicando no botão abaixo.
                                </p>
                                <form class="d-inline" method="POST" action="{{ route('verification.resend', ['user' => $user->id]) }}">
                                    @csrf
                                    <input type="hidden" name="userId" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-primary btn-orange">Reenviar Link</button>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
