@extends('layouts.blog', ['title' => 'Присоединиться к событию'])
@section('content')
    События: <br>
    @foreach($events as  $event)
        <b>{{$event->name}}</b> <br>
        Место: {{$event->place}} <br>
        {{$event->description}} <br>

        Максимальное число участников: {{$event->max_people}}
        <br>
        <div class="container gallery-container">
            <div class="tz-gallery">
                <div class="row">
                    @foreach($event->photo as  $item)
                        <div class="col-sm-6 col-md-4 col-ld">
                            <a class="lightbox" href="<?php echo asset("/images/events/$item->photo_name")?>">
                                <img height="250" src="<?php echo asset("/images/events/$item->photo_name")?>">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div id="eventrequwestapp">
            <eventrequwest :event="{{$event}}"></eventrequwest>
        </div>

        <b>Участники:</b>

        @foreach($event->girls as $part)

        @endforeach

    @endforeach
    <?php echo $events->render(); ?>
    <script>
        baguetteBox.run('.tz-gallery');
    </script>
@endsection
