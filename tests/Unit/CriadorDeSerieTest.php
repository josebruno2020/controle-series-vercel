<?php

namespace Tests\Unit;

use App\Serie;
use App\Services\CriadorDeSerie;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CriadorDeSerieTest extends TestCase
{
    use RefreshDatabase;
   
    public function testCriadorDeSerie()
    {
        $criador_serie = new CriadorDeSerie();
        $nome = 'Nome de Teste';
        $serie_criada = $criador_serie->criarSerie($nome, 1, 1);

        $this->assertInstanceOf(Serie::class, $serie_criada);

        $this->assertDatabaseHas('series', [
            'nome' => $nome
        ]);

        $this->assertDatabaseHas('temporadas', [
            'serie_id' => $serie_criada->id,
            'numero' => 1
        ]);

        $this->assertDatabaseHas('episodios', [
            'numero' => 1
        ]);
    }
}
