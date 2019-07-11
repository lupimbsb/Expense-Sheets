@extends('layouts.header')

@section('conteudo')

    <main role="main">
        <div class="login-bg" style="height: 300px;text-align: center;">
            <span class="helper" style="    display: inline-block;height: 100%;vertical-align: middle;"></span>
            <img src="/images/register.png" style="margin-top: 60px;">
        </div>
        <div class="formas-pagamento whiteBg">
            <div class="container">

                <form class="form-horizontal form-login" action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="row" style="display: none;">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="alert alert-danger" role="alert">
                                This is a danger alert—check it out!
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <h2>Registro</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="no-padding col-md-6 mb-4">
                            <label class="label-input-above" for="nameInput" style="position:absolute;">NOME</label>
                            <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} login-input" type="text"
                                   name="name" id="nameInput"
                                   placeholder="João da Silva" value="{{ old('name') }}" required autofocus>
                            <span class="focus-border"></span>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback position-absolute" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="no-padding col-md-6 mb-4">
                            <label class="label-input-above" for="usernameInput" style="position:absolute;">USUÁRIO</label>
                            <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} login-input" type="text"
                                   name="username" id="usernameInput"
                                   placeholder="joaosilva" value="{{ old('username') }}" required autofocus>
                            <span class="focus-border"></span>
                            @if ($errors->has('username'))
                                <span class="invalid-feedback position-absolute" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="no-padding col-md-6 mb-4">
                            <label class="label-input-above" for="emailInput" style="position:absolute;">E-MAIL</label>
                            <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} login-input" type="email" name="email" id="emailInput"
                                   placeholder="joao@email.com" value="{{ old('email') }}" required>
                            <span class="focus-border"></span>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback position-absolute" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="no-padding col-md-6 mb-4">
                            <label class="label-input-above" for="passwordInput"
                                   style="position:absolute;">SENHA</label>
                            <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} login-input" type="password" name="password"
                                   id="passwordInput" placeholder="*****" required>
                            <span class="focus-border"></span>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback position-absolute" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="no-padding col-md-6 mb-4">
                            <label class="label-input-above" for="password-confirm" style="position:absolute;">CONFIRME
                                A SENHA</label>
                            <input class="login-input" type="password" name="password_confirmation"
                                   id="password-confirm" required>
                            <span class="focus-border"></span>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 25px">
                        <div class="col-md-3"></div>
                        <div class="no-padding col-md-6">
                            <button type="submit" class="btn btn-sm btn-preto-invertido float-right">CONTINUAR</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="login-bg" style="height: 500px;">

            <div class="container" style="padding-top: 50px;">

                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="no-padding col-md-4" style="line-height: 60px;">
                        <span class="login-text">Já possui conta?</span>
                    </div>
                    <div class="col-md-3">
                        <a href="{{route('login')}}" class="btn btn-lg btn-laranja">LOGIN</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

