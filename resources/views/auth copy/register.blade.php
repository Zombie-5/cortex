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

        .bg-dark2{
            background-color: #506566;
            color: white;
        }

        #auth{
            background-image: url('assets/img/devbantu/bg2.jpg');
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
                                <h3>Criar Conta</h3>
                            </div>
                            <form id="signup-form" class="signup-form" method="POST" action="{{ route('store_register') }}">
                                @csrf
                                <div class="alert alert-danger alert-dismissible d-none messagebox" role="alert">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nome</label>
                                        <input type="text" class="form-control input" name="name" id="name" placeholder="Nome" autofocus>
                                    </div>
                                    <div class="col-md-6">
                                        <label>E-mail</label>
                                        <input type="email" class="form-control input" name="email" id="email" placeholder="E-mail" autofocus>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Senha</label>
                                        <input type="password" class="form-control input" name="password" id="password" placeholder="Senha">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Confirme a Senha</label>
                                        <input type="password" class="form-control input" name="password2" id="password2" placeholder="Confirme a Senha">
                                    </div>
                                </div>

                                <div class='form-check clearfix my-4'>
                                    <div class="float-right">
                                        <a href="{{ route('sign-in') }}" style="color: #fd7e14">Tenho uma conta</a>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <input type="submit" class="btn btn-primary float-right bg-orange" style="outline: none; border: 2px solid #fd7e14;" value="Criar Conta" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/auth/assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/auth/assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/auth/assets/js/main.js') }}"></script>

    <script src="{{ asset('assets/site/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/validate/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('assets/js/validate/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/js/validate/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $.validator.addMethod("noNumbers", function(value, element){
                return this.optional(element) || /^[^0-9]*$/.test(value);
            }, "O campo não pode conter números.");

            $("#signup-form").validate({
                rules:
                {
                    name:
                    {
                        required: true,
                        string: true,
                        noNumbers: true,
                    },
                    email:
                    {
                        required: true,
                        email: true,
                    },
                    password:
                    {
                        required: true,
                        minlength: 6,
                    },
                    password2:
                    {
                        required: true,
                        equalTo: "#password",

                    }
                }
            })
        })
    </script>
    <script src="{{ asset('assets/js/validate/messages_pt_PT.js') }}"></script>

    <script src="{{ asset('assets/js/private/signup.js') }}"></script>
</body>

</html>
