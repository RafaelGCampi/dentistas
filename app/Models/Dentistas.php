<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dentistas extends Model
{

    protected $table='dentistas';
    public $timestamps = false;
    protected $fillable = ['nome','email','cro','cro_uf'];

    public function especialidades(){
        return $this->belongsToMany(Especialidades::class,'dentistas_especialidades','dentista_id','especialidade_id');
    }
}
