@extends('layout')

@section('titulo')
    Temporadas de {{$serie->nome}}
@endsection

@section('conteudo')
@if($serie->capa)
    <div class="row mb-5">
        <div class="col-md-12 text-center">
            <a href="{{$serie->capa_url}}" target="_blank">
                <img src="{{$serie->capa_url}}" class="img-thumbnail" height="300" width="300" alt="Capa da Série {{$serie->nome}}">
            </a>
        </div>
    </div>
@endif

<ul class="list-group">
    @foreach($temporadas as $temp)
        <li class="list-group-item d-flex justify-content-between align-align-items-center">

            <a href="/temporadas/{{$temp->id}}/episodios">
                Temporada {{$temp->numero}}
            </a>
            <span class="badge badge-secondary">
                {{$temp->getEpisodiosAssistidos()->count()}} 
                / 
                {{$temp->episodios->count()}}
            </span>
        </li>
    @endforeach
</ul>
    
@endsection