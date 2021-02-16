<?php

namespace App\Listeners;

use App\Events\NovaSerie;
use App\Mail\NovaSeries;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EnviarEmailNovaSerie implements ShouldQueue
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
     * @param  NovaSerie  $event
     * @return void
     */
    public function handle(NovaSerie $event)
    {
        $users = User::all();
        foreach ($users as $i => $user) 
        {
            $multipliacdor = $i +1;
            $email = new NovaSeries(
                $event->nome,
                $event->temporadas,
                $event->episodios
            );
            $email->subject('Nova Série cadastrada!');
            $delay = now()->addSeconds($multipliacdor * 8);
            Mail::to($user->email)->later(
                $delay,
                $email
            );
        }
    }
}
