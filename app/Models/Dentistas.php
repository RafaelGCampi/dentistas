<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dentistas extends Model
{
    use HasFactory;
    protected $table='dentistas';

    public function especialidades(){
        return $this->belongsToMany(Especialidades::class,'dentistas_especialidades','dentista_id','especialidade_id');
    }
}
