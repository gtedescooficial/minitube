<hr>
<h4 class="text-dark">
Comentarios</h4>
<hr>

@if(session('message'))
    <div class="alert alert-success text-white">
    <strong> {{ session('message') }} </strong>
    </div>
@endif

@if(isset($video->comments))
    <article class="row">
        <div class="col-4 col-offset-4">
            @foreach($video->comments as $c)
            <hr>
            <blockquote class="blockquote">
  <p class="mb-0">{{ $c->body }}.</p>
  <footer class="blockquote-footer">Disse o usuario <cite title="Source Title">{{ $c->user->name }}</cite> {{ \FormatTime::LongTimeFilter($c->created_at) }}</footer>
</blockquote>
            <hr>
            @endforeach
        </div>
    </article>
@endif

@if(\Auth::check())
<form  method="post" action=" {{url('/comment')}}">
    <input type="hidden" name="video_id" required value="{{$video->id}}">

    <p>
        <textarea rows="" cols="" required class="form-control" name="body"></textarea>
    </p>
    <button class="btn btn-primary" type="submit">Comentar</button>
        @csrf 


</form>
@endif