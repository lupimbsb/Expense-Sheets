<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="/images/favicon.ico">
    <title>Gastos</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 4.3.1 -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/AdminLTE.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/fontawesome/src/all.min.css">
    <!-- ChartJs -->
    <link rel="stylesheet" href="/css/Chart.min.css">
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper" @if(Request::is('login'))style="background-color: #343a40;"@endif>
    @auth
        <header class="main-header">
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <a class="navbar-brand" href="/">Gastos</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{Request::is('/') ? 'active' : ""}}">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item {{Request::is('divida/*') || Request::is('divida') ? 'active' : ""}}">
                            <a class="nav-link" href="/divida">Dívidas</a>
                        </li>
                        <li class="nav-item {{Request::is('pagamento/*') || Request::is('pagamento') ? 'active' : ""}}">
                            <a class="nav-link" href="/pagamento">Pagamentos</a>
                        </li>
                        <li class="nav-item {{Request::is('user/*') || Request::is('user') ? 'active' : ""}}">
                            <a class="nav-link" href="/user">Usuários</a>
                        </li>
                        <li class="nav-item {{Request::is('tipo/*') || Request::is('tipo') ? 'active' : ""}}">
                            <a class="nav-link" href="/tipo">Tipos</a>
                        </li>
                    </ul>
                    @if(Request::is('/'))
                        <div style="color:white;margin-right:20px;">
                            <select id='month' class="form-control" onchange="change_month(this.value)">
                                @foreach($months as $key => $month)
                                    <option {{isset($month['current']) ? 'selected' : ''}} value='{{$key}}'>{{$month['date']}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <form class="form-inline my-2 my-lg-0" id="logout-form" action="{{ route('logout') }}"
                          method="POST">
                        @csrf
                        <span class="text-white-50 margin-r-5">{{Auth::user()->username}}</span>
                        <a class="btn btn-success my-2 my-sm-0"
                           href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                    </form>
                </div>
            </nav>
        </header>
    @endauth
<!-- Color Palette -->
    <script src="/js/palette.js"></script>
<!-- ChartJs -->
    <script src="/js/Chart.min.js"></script>
    @yield('conteudo')
</div>
<!-- jQuery 3 -->
<script src="/js/jquery.min.js"></script>
<!-- Bootstrap 4.3.1 -->
<script src="/js/bootstrap.min.js"></script>
<!-- JqueryMask 1.14.15 -->
<script src="/js/jquery.mask.min.js"></script>
<script>
    $(":input").inputmask();

    function change_month(value) {
        document.location.href = "/?month=" + value;
    }
</script>
</body>
</html>
