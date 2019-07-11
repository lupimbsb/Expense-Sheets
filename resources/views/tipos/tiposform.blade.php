@extends('layouts.header')

@section('conteudo')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Tipos
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> home</a></li>
                <li><a href="/tipo/list">tipos</a></li>
                <li class="active">Adicionar Tipo</li>
            </ol>
        </section>

        @include('blocks.messages')

        <section class="content">
            <div class="row">
                <div class="container-fluid">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Adicionar Tipo</h3>
                        </div>
                        <form class="form-horizontal" style='margin-right: 200px;' method="post"
                              action="{{isset($tipo->id) ? '/tipo/'.$tipo->id : '/tipo'}}">
                            @csrf
                            @if(isset($tipo->id))
                                @method('PUT')
                            @endif
                            <input type="hidden" name='id' value="{{$tipo->id ?? ''}}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputDescricao" class="col-sm-2  control-label">Tipo</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputDescricao" name='descricao'
                                               placeholder="Nome..."
                                               value="{{$tipo->descricao ?? old('descricao')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a href="/tipo">
                                    <div style="margin-left: 160px;" class="btn btn-default">Voltar</div>
                                </a>
                                <button type="submit"
                                        class="btn btn-info pull-right">{{isset($tipo->id) ? 'Editar' : 'Adicionar'}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>


@stop
