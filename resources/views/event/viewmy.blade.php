@extends('layouts.blog', ['title' => 'Мои события'])
@section('content')
    <div class="row">
        <h2>{{$event->name}}<br></h2>
        Место: {{$event->place}}<br>
        Начало: {{$event->begin}}<br>
        Заявки принимаються до: {{$event->end_applications}}<br>
        Описание: {{$event->description}} <br>
        Статус: {{$event->status_name}} <br>

        Список подавших заявку:

    </div>



@endsection