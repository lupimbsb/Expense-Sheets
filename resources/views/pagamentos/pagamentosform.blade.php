@extends('layouts.header')

@section('conteudo')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Pagamentos
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> home</a></li>
                <li><a href="/pagamento/list">pagamentos</a></li>
                <li class="active">Adicionar Pagamento</li>
            </ol>
        </section>

        @include('blocks.messages')

        <section class="content">
            <div class="row">
                <div class="container-fluid">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Adicionar Pagamento</h3>
                        </div>
                        <form class="form-horizontal" style='margin-right: 200px;' method="post"
                              action="{{isset($pagamento->id) ? '/pagamento/'.$pagamento->id : '/pagamento'}}">
                            @csrf
                            @if(isset($pagamento->id))
                                @method('PUT')
                            @endif
                            <input type="hidden" name='id' value="{{$pagamento->id ?? ''}}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputUser" class="col-sm-2  control-label">Pagador</label>

                                    <div class="col-sm-10">
                                        <select class="form-control" id="inputUser" name='user_id'>
                                            @foreach($users as $u)
                                                <option value="{{$u->id}}"
                                                        {{(!isset($pagamento->user->id) && Auth::user()->id == $u->id) ? 'selected' : ''}}
                                                        {{(isset($pagamento->user->id) && $pagamento->user->id == $u->id) ? 'selected' : ''}}>
                                                    {{$u->username}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputValor" class="col-sm-2  control-label">Valor</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control text-left valor" id="inputValor" name='valor'
                                               placeholder="R$ 00,00" data-inputmask="'alias': 'numeric', 'groupSeparator': '',
                                                'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
                                               value="{{$pagamento->valor ?? old('valor')}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="updated_at" class="col-sm-2  control-label">Data</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control pull-right date" id="data_referencia"
                                               name="data_referencia" placeholder="__/__/____" maxlength="10"
                                               value="{{$pagamento->data_referencia ?? old('data_referencia', date("d/m/Y"))}}">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a href="/pagamento">
                                    <div style="margin-left: 160px;" class="btn btn-default">Voltar</div>
                                </a>
                                <button type="submit"
                                        class="btn btn-info pull-right">{{isset($pagamento->id) ? 'Editar' : 'Adicionar'}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

@stop
