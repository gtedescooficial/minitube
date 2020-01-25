@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-md-8 col-md-offset-4">
   
    <h4>{{ $video->title }} </h4>
    <hr></br>
    

 <video controls id="videoplayer" class="embed-responsive embed-responsive-16by9">
    <source   src="{{ route('videofile',['filename'=>$video->video_path]) }}" 
>

        Seu navegador não suporta a reprodução de videos Html
 </video>
 <hr>
 <footer>
 <div class="card">
  <div class="card-header">
  Criado por <strong> {{ $video->user->name }} </strong>  {{ \FormatTime::LongTimeFilter($video->created_at) }}
  </div>
  <div class="card-body">
    <h5 class="card-title h5 text-center "><u>{{ $video->title }}</u></h5>
    <p class="card-text">{{ $video->description }}.</p>
   
  </div>
</div>

  @include('video.comments')  
 </footer>
</div>


       


    

    
    </div>
</div>


@endsection