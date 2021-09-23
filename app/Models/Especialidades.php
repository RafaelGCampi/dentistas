<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidades extends Model
{
    protected $table='especialidades';

    public function dentistas(){
        return $this->belongsToMany(Dentistas::class,'dentistas_especialidades','especialidade_id','dentista_id');
    }
}
