<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDentistasEspecialidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dentistas_especialidades', function (Blueprint $table) {
            $table->bigInteger('especialidade_id')->unsigned();
            $table->bigInteger('dentista_id')->unsigned();

            $table->foreign('especialidade_id')->references('id')->on('especialidades');
            $table->foreign('dentista_id')->references('id')->on('dentistas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dentistas_especialidades');
    }
}
