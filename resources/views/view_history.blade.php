@extends('layouts.blog', ['title' => 'Кто смотрел мою анкету'])

@section('content')

    @foreach($history as $item)

    @endforeach
    <?php echo $girls->render(); ?>
@endsection