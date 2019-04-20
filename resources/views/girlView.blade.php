@extends('layouts.blog', ['title' => $girl->name])



@section('content')



    <img width="200" src="<?php echo asset("/images/upload/$girl->main_image")?>">
    {{$girl->status}}
    @if (Auth::guest())
        <br>
        <b><a href="{{ url('/login') }}">Войдите</a></b> или
        <b><a href="{{ url('/join') }}">зарегистрируйтесь</a></b>
        что-бы писать сообщения, смотреть скрытую информацию и скрытые фотографии.
    @else
        @if($girl->user_id!=auth()->user()->id)
            <br>
            <div class="card-body" id="app7">
                <br>
                <privatepanel :id="{{$girl->id}}" :user_id="{{$girl->user_id}}"></privatepanel>
            </div>
        @else
            <br>
            <a class="btn btn-primary" href="{{route('girlsEditAuchAnket')}}"> Редактировать анкету</a>
        @endif
        @if(auth()->user()->get_id()!=$girl->user_id)
        @endif
    @endif

    <div class="card-body" id="likesApp">
        @if (Auth::guest())
            <likes></likes>
        @else
            <likes :user="{{auth()->user()}}"></likes>
        @endif
    </div>

    <h4 class="card-title">
        {{$girl->name}}
    </h4>

    <b>Пол:</b>
    @if($girl->sex=='famele')
        <b> Женский</b>
    @endif

    @if($girl->sex=='male')
        <b> Мужской</b>
    @endif
    <br>

    <p class="card-text"><b>Рост : {{$girl->height}}</b>
    <p class="card-text"><b>Вес : {{$girl->weight}}</b>
    <p class="card-text"><b>Возраст : {{$girl->age}}</b>

    <p class="card-text"><b>Хочу встретиться с :</b> @if($girl->meet=='famele')
            <b> женщиной</b>
        @endif

        @if($girl->meet=='male')
            <b> мужчиной</b>
        @endif
        <br>
        <b>Цели знакомства:</b> <br>

    @foreach($targets as $target)
        <li>{{$target->name}}</li>
    @endforeach
    <br>

    <b>Интересы</b>
    @foreach($interes as $target)
        <li>{{$target->name}}</li>
    @endforeach
    <br>
    <b>Город:</b> <br>
    @if($city!=null)
        {{$city->name}}
    @endif



    <br><br>   <br><br>

    <b> {!!$girl->description  !!}</b>

    <br>
    <div class="container gallery-container">
        <div class="tz-gallery">

            <div class="row">
                @foreach($images as $image)
                    <div class="col-sm-6 col-md-4 col-ld">
                        <a class="lightbox" href="<?php echo asset("/images/upload/$image->photo_name")?>">
                            <img height="250" src="<?php echo asset("/images/upload/$image->photo_name")?>">
                        </a>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

    @if($girl->private!=null)
        <label>Приватное сообщение:</label>
        <p class="card-text>"><b>{!!$girl->private  !!}<</b></p>
        @if (empty($privatephotos))
        @else
            <label>Приватные фотографии:</label>
            <div class="container gallery-container">
                <div class="tz-gallery">
                    <div class="row">
                        @foreach($privatephotos as $image)
                            <div class="col-sm-7 col-md-7 col-ld">
                                <a class="lightbox" href="<?php echo asset("/images/upload/$image->photo_name")?>">
                                    <img height="200"
                                         src="<?php echo asset("/images/upload/$image->photo_name")?>">
                                </a>
                            </div>
                            <div class="col-sm-6 col-md-4 col-ld"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endif
    <br>
    <a class="btn btn-primary" href="{{route('main')}}" role="link" onclick=" relocate_home()">К списку анкет</a>


    <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script> -->



    <script>
        baguetteBox.run('.tz-gallery');
    </script>

@endsection
<script>
    import Likes from "./likes";

    export default {
        components: {Likes}
    }
</script>