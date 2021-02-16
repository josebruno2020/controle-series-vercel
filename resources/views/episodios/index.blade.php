@extends('layout')

@section('titulo')
    Episodios
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

<form action="/temporadas/{{$temporadaId}}/episodios/assistir" method="post">
    @csrf
    <ul class="list-group">
        @foreach($episodios as $epi)
            <li class="list-group-item d-flex justify-content-between align-align-items-center">
                Episódio {{$epi->numero}}
                <input 
                    type="checkbox" 
                    name="episodios[]" 
                    value="{{$epi->id}}"
                    {{$epi->assistido ? 'checked' : ''}}                   
                >
            </li>
        @endforeach
    </ul>
    <button class="btn btn-primary mt-2 mb-2">Salvar</button>
</form>
@endsection