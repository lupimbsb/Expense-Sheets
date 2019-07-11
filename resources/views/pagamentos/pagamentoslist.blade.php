@extends('layouts.header')

@section('conteudo')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Pagamentos
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> home</a></li>
                <li class="active">Pagamentos</li>
            </ol>
        </section>

        @include('blocks.messages')

        <section class="content">
            <div class="row">
                <div class="container-fluid">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Listar Pagamentos</h3>
                        </div>
                        <a href="/pagamento/create">
                            <div style="margin-left: 10px;" class="btn btn-default">Adicionar Pagamento</div>
                        </a>
                        <div class="box-body">

                            <div id="tabelaUsuarios_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <table id="tabelaUsuarios" class="table table-bordered table-striped dataTable"
                                       role="grid" aria-describedby="tabelaUsuarios_info">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Data</th>
                                        <th>Pagador</th>
                                        <th>Valor</th>
                                        <th>Opções</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($pagamentos as $t)
                                        <tr>
                                            <td>{{$t->id }}</td>
                                            <td>{{$t->data_referencia }}</td>
                                            <td>{{$t->user->username }}</td>
                                            <td>{{$t->valor }}</td>
                                            <td>
                                                <a href="/pagamento/{{$t->id}}/edit">
                                                    <i class="fa fa-edit"
                                                       style="font-size: 18px; color:#f39c12; margin: 0 5px;"></i>
                                                </a>
                                                <a href="/pagamento/destroy/{{$t->id}}"
                                                   onclick="return confirm('Tem certeza que deseja deletar esse pagamento?')">
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
                                        <th>Pagador</th>
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
