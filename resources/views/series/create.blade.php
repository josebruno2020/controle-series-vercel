@extends('layout')

@section('titulo')
    Adicionar Série
@endsection   

@section('conteudo')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="" method="post" class="form" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-8">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" class="form-control" id="nome" autofocus="true">
            </div>

            <div class="col-2">
                <label for="qtd_temporadas">Nº de temporadas:</label>
                <input type="number" name="qtd_temporadas" class="form-control" id="qtd_temporadas" autofocus="true">
            </div>

            <div class="col-2">
                <label for="ep_temporada">Ep. por temporadas:</label>
                <input type="number" name="ep_temporada" class="form-control" id="ep_temporada" autofocus="true">
            </div>
        </div>
        <div class="row">
            <div class="col col-12">
                <label for="capa">Capa:</label>
                <input type="file" name="capa" class="form-control-file" id="capa" autofocus="true">
            </div>
        </div>
        <button class="btn btn-primary mt-2">Adicionar</button>
    </form>
@endsection

