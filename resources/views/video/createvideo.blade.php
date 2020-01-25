@extends('layouts/app')

@section('content')
<h2 class="text-center">Criar novo video</h2>
<hr>
<div class="container ">
    <div class="row">
    <form action="{{ route('saveVideo')}}" method="post" enctype="multipart/form-data" class="col-7" name="videoform" id="videoform">
    @if($errors->any())
<div class="alert alert-danger">
    <ul>
    @foreach( $errors->all() as $e)
        <li> {{ $e }} </li>
        
    @endforeach
    </ul>
</div>

    @endif
   @csrf
  <div class="form-group">
    <label for="title">Titulo</label>
    <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
  </div>
  <div class="form-group">
    <label for="description">Descripção</label>
    <textarea name="desc" id="desc" cols="85" rows="10"> {{old('desc')}}</textarea>
  </div>
  <div class="form-group">
    <label for="image">Miniatura</label>
    <input type="file" class="form-control-file" id="image" name="image" value="{{old('image')}}">
  </div>
  <div class="form-group">
    <label for="video">Arquivo de video</label>
    <input type="file" class="form-control" id="video" name="video" value="{{old('video')}}">
  </div>
        <button class="btn btn-primary btn-block" type="submit" > Enviar</button>
</form>
    </div>
</div>
@endsection