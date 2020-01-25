@extends('layouts.app')

@section('content')

<div class="container">
<?php echo "<h4>Sua busca <u><strong> $termo </strong></u> obteve os resultados abaixo listados</h4>"?>
<hr>
    @foreach($videos as $v)

    <p>{{ $v->title }}</p>

<hr>

            <span class="text-success"> Total de <?= $videos->total(); ?> videos.
            </span> 
            {{ $videos->links() }}
        
@endforeach
</div>

@endsection