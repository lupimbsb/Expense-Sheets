@extends('layouts.header')

@section('conteudo')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Dashboard
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <?php if (isset($success)): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Sucesso!</h4>
            <?= $success ?>

        </div>
        <?php endif; ?>
        <?php if (isset($failure)): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Erro!</h4>
            <?= $failure ?>
        </div>
        <?php endif; ?>
        <section class="content">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Planilha mensal</h3>
                </div>
                <div class="box-body">
                    <table id="table_planilha" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Data</th>
                            <th>Pagador</th>
                            <th>Gasto</th>
                            <th>Descrição</th>
                            @if($total['total'] = 0)@endif
                            @foreach($users as $u)
                                @if($total[$u->id] = 0)@endif
                                <th>{{$u->username}}</th>
                            @endforeach
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dividas as $d)
                            @if($total['total'] += $d->valor)@endif
                            <tr>
                                <td>{{$d->data_referencia}}</td>
                                <td>{{$d->user->username}}</td>
                                <td>{{$d->tipo->descricao}}</td>
                                <td>{{$d->tipo_desc}}</td>
                                @foreach($users as $u)
                                    @if($d->devedores->contains("user_id", $u->id))
                                        @if($total[$u->id] += $d->valor * ($d->devedores->where("user_id", $u->id)->first()->porcentagem))@endif
                                        <td>
                                            R$ {{$d->valor * ($d->devedores->where("user_id", $u->id)->first()->porcentagem)}}
                                        </td>
                                    @else
                                        <th>-</th>
                                    @endif
                                @endforeach
                                <td>R$ {{$d->valor}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        @foreach($users as $u)
                            <th>R$ {{$total[$u->id]}}</th>
                        @endforeach
                        <th>R$ {{$total['total']}}</th>
                        </tfoot>
                    </table>
                </div>
            </div>
            @foreach($users as $u)
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Total - {{$u->username}}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td>Dívidas Passadas</td>
                                <td>
                                    R$ {{$arrayTotais["dividasPassadas"][$u->id] - $arrayTotais["pagamentosPassados"][$u->id]}}</td>
                            </tr>
                            <tr>
                                <td>Dívidas esse Mês</td>
                                <td>R$ {{$arrayTotais["dividasRecentes"][$u->id]}}</td>
                            </tr>
                            <tr>
                                <td>Pagamentos</td>
                                <td>R$ {{$arrayTotais["pagamentosRecentes"][$u->id]}}</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <th>Total</th>
                            <th style="color:{{$arrayTotais["total"][$u->id] > 0 ? "red" : "green"}}">R$ {{$arrayTotais["total"][$u->id]}}</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
    <script>
    </script>
@stop
