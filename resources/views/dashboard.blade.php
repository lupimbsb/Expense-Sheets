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

        @include('blocks.messages')

        <section class="content">

            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Adicionar</h3>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                   aria-controls="home" aria-selected="true">Dívidas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                   aria-controls="profile" aria-selected="false">Pagamentos</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade" id="home" role="tabpanel"
                                 aria-labelledby="home-tab">
                                <form class="form-horizontal" style='margin-right: 200px;' method="post"
                                      action="/divida">
                                    @csrf
                                    <input type="hidden" name='id'>
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

                                            <label for="inputDescTipo" class="col-sm-2  control-label">Desc.</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputDescTipo"
                                                       name='tipo_desc'
                                                       placeholder="Descrição adicional">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputValor" class="col-sm-2  control-label">Valor</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control text-left" id="inputValor"
                                                       name='valor'
                                                       data-inputmask="'alias': 'numeric', 'groupSeparator': '',
                                                'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="updated_at" class="col-sm-2  control-label">Data</label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control pull-right"
                                                       id="data_referencia"
                                                       name="data_referencia" data-inputmask-alias="datetime"
                                                       data-inputmask-inputformat="dd/mm/yyyy"
                                                       data-inputmask-placeholder="00/00/0000"
                                                       value="{{date("d/m/Y")}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2  control-label">Devedores</label>
                                            @foreach($users as $u)
                                                <div class="col-sm-10" class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="{{$u['id']}}" name="user_id[]"
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
                                        <button type="submit" class="btn btn-info pull-right">Adicionar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form class="form-horizontal" style='margin-right: 200px;' method="post"
                                      action="/pagamento">
                                    @csrf
                                    <input type="hidden" name='id'>
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
                                                <input type="text" class="form-control text-left" id="inputValor"
                                                       name='valor' placeholder="R$ 00,00"
                                                       data-inputmask="'alias': 'numeric', 'groupSeparator': '',
                                                'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="updated_at" class="col-sm-2  control-label">Data</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control pull-right"
                                                       id="data_referencia"
                                                       name="data_referencia" data-inputmask-alias="datetime"
                                                       data-inputmask-inputformat="dd/mm/yyyy"
                                                       data-inputmask-placeholder="00/00/0000"
                                                       value="{{date("d/m/Y")}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <a href="/pagamento">
                                            <div style="margin-left: 160px;" class="btn btn-default">Voltar</div>
                                        </a>
                                        <button type="submit" class="btn btn-info pull-right">Adicionar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Gastos do Mês</h3>
                        </div>
                        <div class="box-body">
                            <div style="width:100%; margin:23px 0;">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                    @if($d->devedores->contains("user_id", $u->id) && $d->user->id != $u->id)
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
                            <th style="color:{{$arrayTotais["total"][$u->id] > 0 ? "red" : "green"}}">
                                R$ {{$arrayTotais["total"][$u->id]}}</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');

        var data = [
            @foreach($dividasPorTipo as $dt)
            {{$dt}},
            @endforeach
        ];
        var dataLabels = [
            @foreach($dividasPorTipo as $key => $dt)
                '{{$key}}',
            @endforeach
        ];
        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: data,
                    backgroundColor: palette('mpn65', data.length).map(function (hex) {
                        return '#' + hex;
                    })
                }],
                labels: dataLabels
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: false
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        };

        window.onload = function () {
            window.myDoughnut = new Chart(ctx, config);
        };
    </script>
@stop
