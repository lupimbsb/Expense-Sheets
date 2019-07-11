@extends('layouts.header')

@section('conteudo')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Usuários
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> home</a></li>
                <li class="active">Usuários</li>
            </ol>
        </section>

        @include('blocks.messages')

        <section class="content">
            <div class="row">
                <div class="container-fluid">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Listar Usuários</h3>
                        </div>
                        <a href="/user/create">
                            <div style="margin-left: 10px;" class="btn btn-default">Adicionar Usuário</div>
                        </a>
                        <div class="box-body">

                            <div id="tabelaUsuarios_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <table id="tabelaUsuarios" class="table table-bordered table-striped dataTable"
                                       role="grid" aria-describedby="tabelaUsuarios_info">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Usuário</th>
                                        <th>Opções</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $u)
                                        <tr>
                                            <td>{{$u->id }}</td>
                                            <td>{{$u->username }}</td>
                                            <td>
                                                <a href="/user/{{$u->id}}/edit">
                                                    <i class="fa fa-edit"
                                                       style="font-size: 18px; color:#f39c12; margin: 0 5px;"></i>
                                                </a>
                                                <a href="/user/destroy/{{$u->id}}"
                                                   onclick="return confirm('Tem certeza que deseja deletar esse usuário?')">
                                                    <i class="fa fa-trash" style="font-size: 18px; color:#dd4b39;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Usuário</th>
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
