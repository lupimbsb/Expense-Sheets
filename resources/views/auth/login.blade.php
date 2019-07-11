@extends('layouts.header')

@section('conteudo')

    <main role="main">
        <div class="login-box">
            <div class="login-logo">
                <a href="/"><b>Gastos</b></a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Faça o Login</p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Usuario" name="username"
                               value="{{ old('username') }}" required autofocus>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Senha" name="password" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="row" style="float: right; margin-right: 10px;">
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->

    </main>

@stop
