@extends('layouts.blog', ['title' => 'Кто смотрел мою анкету'])

@section('content')
    @if($today!=null)
        Сегодня
        <br>
        <div class="row">
            @foreach($today as $item)
                <div class="col-lg-4 col-md-3 col-sm-5 col-xs-9 box-shadow">
                    <div class="card  border-dark" style="width: 18rem; background-color: #eeeeee;
             border: 1px solid transparent;
             border-color: #666869;
">
                        <div class="card-body">
                            <a href="{{route('showGirl',['id'=>$item->girl_id])}}">
                                <img height="150" width="150"
                                     src="<?php echo asset("/images/small/$item->main_image")?>">
                            </a>
                            {{$item->time}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <br>

    @if($this_week!=null)
        <div class="row">
            На этой неделе
            <br>
            @foreach($this_week as $item)
                <div class="col-lg-4 col-md-3 col-sm-5 col-xs-9 box-shadow">
                    <div class="card  border-dark" style="width: 18rem; background-color: #eeeeee;
             border: 1px solid transparent;
             border-color: #666869;
">
                        <div class="card-body">
                            <a href="{{route('showGirl',['id'=>$item->girl_id])}}">
                                <img height="150" width="150"
                                     src="<?php echo asset("/images/small/$item->main_image")?>">
                            </a>
                            {{$item->time}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <?php echo $today->render(); ?>
@endsection