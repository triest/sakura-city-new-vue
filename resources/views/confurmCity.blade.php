@extends('layouts.blog', ['title' => 'Список анкет'])

@section('content')
    Ваш город {{$city->city->name_ru}}?

    <form action="{{route('agreeCity')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="city_name" id="city_name" value="{{$city->city->name_ru}}">
        <input type="hidden" name="city_id" id="city_id" value="{{$city->city->id}}">
        <button type="submit" class="btn btn-default">Да</button>
    </form>

    Если нет, начните вводить название, а за тем выбирите из списка.
    <label>Город</label>
    <input name="cityname" id="cityname" oninput="findCity();" type="text"/>
    <label>Выбирите из списка:
        <select id="city" class="city" style="width: 200px" name="city">
            <option value="-">-</option>
        </select>
    </label>
    <br>

    <script>
        function findCity() {
            var inputcity = document.getElementById('cityname').value;
            console.log(inputcity);
            var x = document.getElementById("city");
            var option = document.createElement("option");
            axios.get('/findcity/' + inputcity, {
                params: {}
            })
                .then((response) => {
                    var data = response.data;
                    $('#city').empty();
                    for (var i = 0; i <= data[0].length; i++) {
                        $('#city').append('<option value="' + data[0][i].id + '">' + data[0][i].name + '</option>');
                    }
                });
        }
    </script>

@endsection