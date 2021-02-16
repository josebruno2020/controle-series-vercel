@extends('layout')

@section('titulo')
    Series
@endsection

@section('conteudo')
@include('mensagem', ['mensagem' => $mensagem])
    
    @auth
    <a href="{{ route('criar_serie')}}" class="btn btn-dark mb-2">Adicionar</a>
    @endauth

    <ul class="list-group">
        @foreach($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <img src="{{$serie->capa_url}}" class="img-thumbnail" height="100" width="100" alt="Capa da Série {{$serie->nome}}">
                
                    <span id="nome-serie-{{ $serie->id }}">
                        {{ $serie->nome }}
                    </span>
                </div>
                <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                    <input type="text" class="form-control" value="{{ $serie->nome }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>

                <spam class="d-flex">
                    @auth
                    <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{$serie->id}})">
                    
                        <i class="fas fa-edit"></i>
                    </button>
                    @endauth
                    <a href="series/{{$serie->id}}/temporadas" class="btn btn-info btn-sm mr-1">
                        <i class="fas fa-external-link-alt "></i>
                    </a>
                    <form action="/series/{{$serie->id}}" 
                        method="post" 
                        onsubmit="return  confirm('Tem certeza que deseja remover a série {{$serie->nome}}');">
                    @csrf
                    @method('DELETE')
                    @auth
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    @endauth
                    </form>
                </spam>
            </li>
            
        @endforeach
    </ul>
    <script>
        //Função para esconder ou mostar o input que altera o nome da série;
        function toggleInput(serieId){
            const nomeSerieEl = document.getElementById('nome-serie-'+serieId);
            const inputSerieEl = document.getElementById('input-nome-serie-'+serieId);
            //Caso o nome esteja escondido, mostramos ele e escondemos o input;
            if(nomeSerieEl.hasAttribute('hidden')){
                nomeSerieEl.removeAttribute('hidden');
                inputSerieEl.hidden = true;


            } else{

                inputSerieEl.removeAttribute('hidden');
                nomeSerieEl.hidden = true;

            }
        }

        function editarSerie(serieId){
            
            let formData = new FormData();

            const nome = document
                .querySelector(`#input-nome-serie-${serieId} > input`)
                .value;
            const token = document.querySelector('input[name="_token"]').value;
            
            formData.append('nome', nome);
            formData.append('_token', token);
            
            const url = `series/${serieId}/editaNome`;
            fetch(url, {
                body: formData,
                method:'post'

            }).then(() => {

                toggleInput(serieId);
                document.getElementById('nome-serie-'+serieId).textContent = nome;
            });
        }
    </script>
@endsection