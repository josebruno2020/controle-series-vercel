<?php

namespace App\Services;

use App\Serie;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(
        string $nomeSerie, 
        int $qt_temporada, 
        int $ep_temporada,
        ?string $capa
    ) : Serie
    {
        //Colocando uma transaction que garante que so irá fazer alterações no banco de dados, se tudo ocorrer bem no funcionamento do cógido e servidor;
        DB::beginTransaction();
        
        $serie = Serie::create([
            'nome' => $nomeSerie,
            'capa' => $capa
        ]);
        $this->criaTemporada($serie, $qt_temporada, $ep_temporada);
        
        DB::commit();
        
        return $serie;
    }

    private function criaTemporada(Serie $serie, $qt_temporada, $ep_temporada)
    {
        $qt_temporada = $qt_temporada;
        for($i=1;$i<=$qt_temporada;$i++){

            $temporada = $serie->temporadas()->create(['numero' => $i]);
            $this->criaEpisodio($ep_temporada, $temporada);

        }
    }

    private function criaEpisodio($ep_temporada, $temporada)
    {
        for($j=1;$j<=$ep_temporada;$j++){
                
            $temporada->episodios()->create(['numero' => $j]);

        }
    }
}