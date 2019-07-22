@extends('layouts.header')

@section('conteudo')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Usuários
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> home</a></li>
                <li><a href="/dividas/list">dívidas</a></li>
                <li class="active">@if(isset($divida->id)) Editar @else Adicionar @endif Dívida</li>
            </ol>
        </section>

        @include('blocks.messages')

        <section class="content">
            <div class="row">
                <div class="container-fluid">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@if(isset($divida->id)) Editar @else Adicionar @endif Dívida</h3>
                        </div>
                        <form class="form-horizontal" style='margin-right: 200px;' method="post"
                              action="{{isset($divida->id) ? '/divida/'.$divida->id : '/divida'}}">
                            @csrf
                            @if(isset($divida->id))
                                @method('PUT')
                            @endif
                            <input type="hidden" name='id' value="{{$divida->id ?? ''}}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputPagador" class="col-sm-2  control-label">Pagador</label>

                                    <div class="col-sm-10">
                                        <select class="form-control" id="inputPagador" name='user_id'>
                                            @foreach($users as $user)

                                                <option value="{{$user->id}}" {{(Auth::user()->id == $user->id) ? 'selected' : ''}}>
                                                    {{$user->username}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputTipo" class="col-sm-2  control-label">Tipo</label>

                                    <div class="col-sm-10">
                                        <select class="form-control" id="inputTipo" name='tipo_id'>
                                            @foreach($tipos as $tipo)

                                                <option value="{{$tipo->id}}" {{(isset($tipo->mirror_id) && $tipo->mirror_id == $tipo->id) ? 'selected' : ''}}>
                                                    {{$tipo->descricao}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="inputDescTipo" class="col-sm-2  control-label">Descrição</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputDescTipo" name='tipo_desc'
                                               placeholder="Descrição adicional"
                                               value="{{$divida->tipo_desc ?? old('tipo_desc')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputValor" class="col-sm-2  control-label">Valor</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control text-left" id="inputValor" name='valor'
                                               placeholder="R$ 00.00" data-inputmask="'alias': 'numeric', 'groupSeparator': '',
                                                'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                               value="{{$divida->valor ?? old('valor')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="updated_at" class="col-sm-2  control-label">Data</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control pull-right" id="data_referencia"
                                               name="data_referencia" data-inputmask-alias="datetime"
                                               data-inputmask-inputformat="dd/mm/yyyy"
                                               data-inputmask-placeholder="00/00/0000"
                                               value="{{$divida->data_referencia ?? old('data_referencia', date("d/m/Y"))}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2  control-label">Devedores</label>
                                    @foreach($users as $u)
                                        <div class="col-sm-10" class="checkbox">
                                            <label>
                                                <input type="checkbox" value="{{$u['id']}}" name="user_id[]"
                                                @if(isset($divida->id))
                                                    {{$divida->devedores->contains('user_id',$u['id']) ? "checked" : ''}}
                                                        @endif
                                                        {{Auth::user()->id != $u['id'] ? 'checked' : ''}}>
                                                {{$u['username']}}
                                            </label>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="box-footer">
                                <a href="/divida">
                                    <div style="margin-left: 160px;" class="btn btn-default">Voltar</div>
                                </a>
                                <button type="submit"
                                        class="btn btn-info pull-right">{{isset($divida->id) ? 'Editar' : 'Adicionar'}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

@stop
