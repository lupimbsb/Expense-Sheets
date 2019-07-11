@extends('layouts.header')

@section('conteudo')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Usuários
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> home</a></li>
                <li><a href="/user/list">usuários</a></li>
                <li class="active">Adicionar Usuário</li>
            </ol>
        </section>

        @include('blocks.messages')

        <section class="content">
            <div class="row">
                <div class="container-fluid">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Adicionar Usuário</h3>
                        </div>
                        <form class="form-horizontal" style='margin-right: 200px;' method="post"
                              action="{{isset($user->id) ? '/user/'.$user->id : '/user'}}">
                            @csrf
                            @if(isset($user->id))
                                @method('PUT')
                            @endif
                            <input type="hidden" name='id' value="{{$user->id ?? ''}}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputUsername3" class="col-sm-2  control-label">Usuário</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputUsername3" name='username'
                                               placeholder="Login..."
                                               value="{{$user->username ?? old('username')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="col-sm-2  control-label">Senha</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword"
                                               name='password'
                                               id="passwordInput" placeholder="*****">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a href="/user">
                                    <div style="margin-left: 160px;" class="btn btn-default">Voltar</div>
                                </a>
                                <button type="submit"
                                        class="btn btn-info pull-right">{{isset($user->id) ? 'Editar' : 'Adicionar'}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

@stop
