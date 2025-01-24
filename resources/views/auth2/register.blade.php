<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cortex - Criar Conta</title>
    <link rel="stylesheet" href="{{ asset('assets/auth/assets/css/bootstrap.css') }}">

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
            background-color: #FFC107;
            color: white; /* Cor do texto */
        }

        .bg-dark2{
            background-color: #506566;
            color: white;
        }

        #auth{
            background-image: url('assets/img/cortex/infla2.webp');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }

        .input:focus{
            outline: none;
            border: 2px solid #FFC107;
        }
    </style>
</head>

<body>
    <div id="auth" >
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <h3>Criar Conta</h3>
                            </div>
                            <form id="signup-form" class="signup-form" method="POST" action="{{ route('auth.store') }}">
                                @csrf
                                <div class="alert alert-danger alert-dismissible d-none messagebox" role="alert">
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control input" name="tel" id="tel" placeholder="telefone" autofocus>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Senha</label>
                                        <input type="password" class="form-control input" name="password" id="password" placeholder="Senha">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Confirme a Senha</label>
                                        <input type="password" class="form-control input" name="password2" id="password2" placeholder="Confirme a Senha">
                                    </div>
                                </div>

                                <div class='form-check clearfix my-4'>
                                    <div class="float-right">
                                        <a href="{{ route('auth.signIn') }}" style="color: #FFC107">Tenho uma conta</a>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <input type="submit" class="btn btn-primary float-right" style="outline: none; border: 2px solid #FFC107;background-color: #e9c80c" value="Criar Conta" />
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
                    tel:
                    {
                        required: true,
                        digits: true,
                        minlength: 9, 
                        maxlength: 9
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
