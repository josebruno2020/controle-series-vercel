<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    public function create()
    {
        return view ('registro.create');
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //Recebendo todos os dados da requisição menos o token;
        $data = $request->except('_token');
        //Criando uma criptografia pronta do Laravel;
        $data['password'] = Hash::make($data['password']);
        //Criando um novo usuario;
        $user = User::create($data);
        //Logando o usuario criado;
        Auth::login($user);

        return redirect()->route('listar_series');
    }
}
