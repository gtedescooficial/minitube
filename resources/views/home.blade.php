@extends('layouts.app')

@section('content')
<div class="container">

@if(session('message'))
    <div class="alert alert-success text-white">
    <strong> {{ session('message') }} </strong>
    </div>
@endif

@if($videos)
    <section class="row ">
        <div class="col-8">
        @foreach($videos as $video)
        <!-- /////////// CARD COMPONENT ////////////////////// -->
      
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    @if( Storage::disk('images')->has($video->image))
                    <img src="{{ url('thumbnail/'.$video->image)}}" class="card-img-top" alt="{{$video->title}}" width="200" height="200">
                    @endif
                </div>

                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"> <a href="{{url('mostrarvideo/'.$video->id)}}">{{ $video->title }}</a></h5>
                        <p class="card-text">{{ $video->description }}.</p>
                        <p class="card-text"><small class="text-muted">{{ $video->user->name }} - {{ $video->user->surname }} </small></p>

                            <a href="{{url('mostrarvideo/'.$video->id)}}" class="btn btn-success">Ver</a>
                        @if( Auth::check() && Auth::user()->id == $video->user->id )
                            <button class="btn btn-warning">Editar</button>
                            <a class="btn btn-danger" href="{{ url('videodelete/'.$video->id)}}">Apagar</a>
                            
                        @endif
                    </div>
                </div>
            </div>
     </div>

   
        
        <!-- ///////////////END CARD COMPONENT///////////////// -->
        
        <hr>
        @endforeach
        </div>

        <div class="col-4">
            <span class="text-success"> Total de <?= $videos->total(); ?> videos.
            </span> 
            {{ $videos->links() }}
        </div>

    </section>
@endif

  
</div>
@endsection
