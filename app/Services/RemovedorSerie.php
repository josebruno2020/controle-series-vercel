<?php

namespace App\Services;

use App\{Episodio, Serie, Temporada};
use App\Events\ExcluirSerieCapa;
use App\Jobs\ExcluirCapaSerie;
use Illuminate\Support\Facades\DB;
class RemovedorSerie{

    public function removerSerie(int $serieId): string
    {
        $nomeSerie = '';   
        DB::transaction(function () use($serieId, &$nomeSerie) {
            $serie = Serie::find($serieId);
            $nomeSerie = $serie->nome;
            $serieObj = (object) $serie->toArray();
            $this->removerTemporadas($serie);
            $serie->delete();
            /**
             * Forma de excluir o arquivo de capa por um evento, que dispara um ouvinte;
             */
            $event = new ExcluirSerieCapa($serieObj);
            event($event);
            /**
             * Forma de excluir o arquivo por um Job, não precisando ser emitido um evento, apenas configurando o próprio job;
             */
            ExcluirCapaSerie::dispatch($serieObj);
        });
        
        
        return $nomeSerie;
    }

    private function removerTemporadas(Serie $serie) : void
    {
        //Método each() -> Para cada;
        $serie->temporadas->each(function(Temporada $temporada){
            $temporada->episodios->each(function(Episodio $episodio){

                $episodio->delete();
            });
            //Temos que deletar os episodios primeiro, depois as temporadas, pois não será encontrado;
            $temporada->delete();
        });
    }

}