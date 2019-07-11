@extends('layouts.header')

@section('conteudo')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Dívidas
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> home</a></li>
                <li class="active">Dívidas</li>
            </ol>
        </section>

        @include('blocks.messages')

        <section class="content">
            <div class="row">
                <div class="container-fluid">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Listar Dívidas</h3>
                        </div>
                        <a href="/divida/create">
                            <div style="margin-left: 10px;" class="btn btn-default">Adicionar Dívida</div>
                        </a>
                        <div class="box-body">

                            <div id="tabelaDividas_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <table id="tabelaDividas" class="table table-bordered table-striped dataTable"
                                       role="grid" aria-describedby="tabelaDividas_info">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Data</th>
                                        <th>Tipo</th>
                                        <th>Descrição</th>
                                        <th>Usuário</th>
                                        <th>Valor</th>
                                        <th>Opções</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($dividas as $d)
                                        <tr>
                                            <td>{{$d->id }}</td>
                                            <td>{{$d->data_referencia }}</td>
                                            <td>{{$d->tipo->descricao }}</td>
                                            <td>{{$d->tipo_desc }}</td>
                                            <td>{{$d->user->username }}</td>
                                            <td>{{$d->valor }}</td>
                                            <td>
                                                <a href="/divida/{{$d->id}}/edit">
                                                    <i class="fa fa-edit"
                                                       style="font-size: 18px; color:#f39c12; margin: 0 5px;"></i>
                                                </a>
                                                <a href="/divida/destroy/{{$d->id}}"
                                                   onclick="return confirm('Tem certeza que deseja deletar esse dívida?')">
                                                    <i class="fa fa-trash" style="font-size: 18px; color:#dd4b39;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Data</th>
                                        <th>Tipo</th>
                                        <th>Descrição</th>
                                        <th>Usuário</th>
                                        <th>Valor</th>
                                        <th>Opções</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@stop
