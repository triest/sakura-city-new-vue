<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}}</title>


    <!--  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}" defer></script>

    <link href="{{asset('css/gallery-grid.css')}}">
    <!-- Bootstrap core CSS -->


    <!-- galeray -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
    <link href="{{asset('css/baguetteBox.min.css')}}">
    <!--table CSS -->
    <!--   <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet"> -->

    <!-- Bootstrap core CSS -->

    <link href="{{asset('css/gallery-grid.css')}}">

    <!-- Bootstrap core CSS -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css"
          rel="stylesheet"/>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css"
          integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <link href="http://bootstrap-3.ru/examples/offcanvas/offcanvas.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">

    <!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!--Yandex -->
    <meta name="yandex-verification" content="af4168af7d682a89"/>
    <style>
        .row.no-gutter {
            margin-left: 0;
            margin-right: 0;
        }

        .row.no-gutter [class*='col-']:not(:first-child),
        .row.no-gutter [class*='col-']:not(:last-child) {
            padding-right: 0;
            padding-left: 0;
        }

        .card {
            background-color: #fff;
            border: 1px solid transparent;
            border-radius: 6px;
        }


    </style>


    <!-- иконка -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <!-- For apple devices -->
    <!--  <link rel="apple-touch-icon" type="image/png" href="/icon.png"/> -->
</head>

<body>


<script src="{{ asset('/js/axios.min.js') }}"></script>


<div class="container" bg-light>
    <div class="card-body" id="app2">
        <carouseltemp></carouseltemp>
    </div>
    <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
            <p class="pull-right visible-xs">
                <button type="button" class="menuButton" data-toggle="offcanvas"><b>Меню</b></button>
            </p>
            <a class="btn btn-primary" href="{{route('main2')}}" role="link">Поиск анкет</a>
            <br><br>
            <div class="row">
                @yield('content')
            </div>
        </div>

        <div class="col-xs-3 col-sm-3  sidebar-offcanvas" id="sidebar" role="navigation">
            <div class="card " style="width: 18rem; background-color: #eeeeee;
             border: 1px solid transparent;
             border-color: #666869;
">
                <div class="card-body" id="app">
                    @if (Auth::guest())
                        <b><a href="{{ url('/login') }}">Войти</a></b><br>
                        <b><a href="{{ url('/join') }}">Зарегистрироваться</a></b>
                    @else
                        <b>{{auth()->user()->name}}</b><br>
                        <b><a href="{{ url('/logout') }}">Выйти</a></b>
                        <br>
                        @if($girl=Auth::user()->anketisExsis()!=null)
                        <!-- {{$girl=Auth::user()->anketisExsis()}} -->
                            <img height="150" width="150"
                                 src="<?php echo asset("images/small/$girl->main_image")?>">
                            <side-panel :user="{{auth()->user()}}"></side-panel>
                            <br>
                            <b><a class="btn btn-primary" href="{{route('myAnket')}}">Моя анкета</a> </b>
                            <br>
                        @else
                            <br>
                            <b><a class="btn btn-primary" href="{{route('createGirlPage')}}">Создать анкету</a> </b>
                            <br>
                        @endif
                        <br>
                        <!--check is admin -->
                        @if(Auth::user()->is_admin==1)
                            <b><a class="btn btn-success" href="{{route('adminPanel')}}">Панель администратора</a> </b>
                            <br>
                        @endif
                        <br>
                        <b><a class="btn btn-success" href="{{route('main')}}">На главную</a> </b>

                    @endif
                </div>
            </div>
        </div>
    </div><!--/span-->
</div>

<script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
<script src="http://bootstrap-3.ru/examples/offcanvas/offcanvas.js"></script>

<!-- скрипт для галлереи -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script src="{{ asset('js/baguetteBox.min.js') }}"></script>
<script src="{{ asset('js/jquery-3.3.1.min.js') }}" defer></script>
<script>
    baguetteBox.run('.tz-gallery');

    function relocate_home() {
        location.href = "www.yoursite.com";
    }
</script>
</body>
</html>