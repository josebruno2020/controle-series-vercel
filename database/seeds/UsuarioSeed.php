<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;

class UsuarioSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Bruno',
            'email' => 'bruno@teste.com',
            'password' => bcrypt('teste')
        ]);
    }
}
