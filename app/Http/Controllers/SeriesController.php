<?php

namespace App\Http\Controllers;

use App\Events\NovaSerie;
use App\Http\Requests\SeriesRquest;
use App\Mail\NovaSeries;
use App\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorSerie;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller
{
    
    public function index(Request $request)
    {   
        //Realizar a query para buscar de forma alfabética os elementos;

        $series = Serie::query()->orderBy('nome')->get();

        $mensagem = $request->session()->get('mensagem');

        
        
        return view('series.index', compact('series', 'mensagem'));
        //O compact retorna o nome da chave do array que tem o mesmo nome na variável;
    }
    
    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesRquest $request, CriadorDeSerie $criadorDeSerie)
    { 
        $capa = null;
        if($request->hasFile('capa')){
            $capa = $request->file('capa')->store('serie');
        }
        
        $serie = $criadorDeSerie->criarSerie(
            $request->nome, 
            $request->qtd_temporadas, 
            $request->ep_temporada,
            $capa
        );
        $eventoNovaSerie = new NovaSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_temporada
        );
        event($eventoNovaSerie);
        
        $request->session()->flash(
            'mensagem', 
            "Série {$serie->id} e suas temporadas e episódios criados com sucesso {$serie->nome}"
        );

        return redirect(route('listar_series'));
    }
    
    public function destroy(Request $request, RemovedorSerie $removedorSerie)
    {
        $nomeSerie = $removedorSerie->removerSerie($request->id);
        
        $request->session()->flash(
            'mensagem', 
            "Série $nomeSerie removida com sucesso!"
        );

        return redirect()->route('listar_series');
    }

    public function editaNome(int $id, Request $request)
    {
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }
}