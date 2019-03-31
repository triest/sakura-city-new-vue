@extends('layouts.blog', ['title' => 'Панель администратора'])
@section('content')

    <b><a class="btn btn-success" href="{{route('presentsControll')}}">Управление подарками</a> </b>

    <b><a class="btn btn-primary" href="{{route('targetsControll')}}">Управление целями</a> </b>
@endsection