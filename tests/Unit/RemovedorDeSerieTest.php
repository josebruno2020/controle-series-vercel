<?php

namespace Tests\Unit;

use App\Services\CriadorDeSerie;
use App\Services\RemovedorSerie;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RemovedorDeSerieTest extends TestCase
{
    use RefreshDatabase;
    private $serie;

    protected function setUp(): void
    {
        parent::setUp();
        $criador =  new CriadorDeSerie();
        $this->serie = $criador->criarSerie('Teste', 2, 3);
    }
    
    public function testRemoverDeSerie()
    {
        $this->assertDatabaseHas('series', [
            'id' => $this->serie->id
        ]);

        $removedor = new RemovedorSerie();
        $nomeSerie = $removedor->removerSerie($this->serie->id);

        $this->assertIsString($nomeSerie);
        $this->assertEquals('Teste', $this->serie->nome);
        $this->assertDatabaseMissing('series', [
            'id' => $this->serie->id
        ]);

    }
}
