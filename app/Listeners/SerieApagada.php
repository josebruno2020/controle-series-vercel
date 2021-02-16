<?php

namespace App\Listeners;

use App\Events\ExcluirSerieCapa;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class SerieApagada implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ExcluirSerieCapa  $event
     * @return void
     */
    public function handle(ExcluirSerieCapa $event)
    {
        $serie = $event->serie;
        if($serie->capa){
            Storage::delete($serie->capa);
        }
    }
}
