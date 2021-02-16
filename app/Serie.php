<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Serie extends Model
{
    
    //Por padrão o Laravel usa o nome em minúsculo e no plural para encontrar o banco de dados. Como bate, nao precisamos indicar qual a tabela;
    //protected $table = 'series';
    public $timestamps = false;

    protected $fillable = ['nome', 'capa'];

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }

    public function getCapaUrlAttribute()
    {

        if($this->capa){
            return Storage::url($this->capa);
        }
        return Storage::url('serie/noimage.png');
    }

}