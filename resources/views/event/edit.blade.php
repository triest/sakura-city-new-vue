@extends('layouts.blog', ['title' => 'Создать событие'])
@section('content')

    <form action="{{route('storeEvent')}}" method="post" enctype="multipart/form-data">
        <br>
        <div class="form-group">
            <label for="title">Имя:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Название события"
                   value="{{$event->name}}"
                   required>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">Описание события:</label><br>
            <textarea name="description" required>{{$event->description}} </textarea>
        </div>
        @if($errors->has('description'))
            <font color="red"><p class="errors">{{$errors->first('description')}}</p></font>
        @endif
        <div class="form-group">
            <label for="title">Место:</label>
            <input type="text" class="form-control" id="place" name="place" placeholder="место события"
                   value="{{$event->place}}"
                   required>
        </div>


        <div class="form-group">
            <div class="dates row">
                <label class="col-md-2 control-label">Дата начала:</label>
                <div class="col-3">
                    <input type="text" class="col form-control form-control-sm" name="begin"
                           id="begin" placeholder="YYYY-MM-DD" autocomplete="off" width="100" value="{{$event->begin}}"
                           required>
                </div>
            </div>
            @if($errors->has('arrival'))
                <font color="red"><p>  {{$errors->first('arrival')}}</p></font>
            @endif
        </div>
        <div class="form-group">
            <div class="dates row">
                <label class="col-md-2 control-label">Дата окончания:</label>
                <div class="col-3">
                    <input type="text" class="col form-control form-control-sm" name="end"
                           id="end" placeholder="YYYY-MM-DD" autocomplete="off" width="100" value="{{$event->end}}"
                           required>
                </div>
            </div>
            @if($errors->has('departure'))
                <font color="red"><p>  {{$errors->first('departure')}}</p></font>
            @endif
        </div>


        <label for="max">Максимальное число участников (если нет ограничения, оставьте пустым):
            <input type="number" name="max" id="min" min="1" value="{{$event->max_people}}" checked>
        </label><br>

        <label for="min">Минимальное число участников (если нет ограничения, оставьте пустым):
            <input type="number" name="min" id="min" min="1" value="{{$event->min_people}}" checked>
        </label><br>


        Фотографии события
        <input type="file" id="images" accept="image/*" name="file" value="{{ old('file')}}">
        @if($errors->has('file'))
            <font color="red"><p>  {{$errors->first('file')}}</p></font>
        @endif
        <select>
            @foreach($statys as $item)
                <option value="{{$item->id}}">  {{$item->status_name}}</option>
            @endforeach
        </select>
        <input type="submit">
    </form>

@endsection