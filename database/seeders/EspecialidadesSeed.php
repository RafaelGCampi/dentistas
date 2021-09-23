<?php

namespace Database\Seeders;

use App\Models\Especialidades;
use Illuminate\Database\Seeder;

class EspecialidadesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $especialidades=[
            array(
            'nome' => 'Clínico geral',
            ),
            array(
                'nome' => 'Especialista em dentística',
            ),
            array(
                'nome' => 'Cirurgião-dentista especializado em estomatologia',
            ),
            array(
                'nome' => 'Endodontista',
            ),
            array(
                'nome' => 'Dentista especializado em implantodontia',
            ),
            array(
                'nome' => 'Dentista especializado em prótese dentária',
            ),
            array(
                'nome' => 'Endodontista',
            ),
            array(
                'nome' => 'Ortodontista',
            ),
            array(
                'nome' => 'Periodontista',
            ),
            array(
                'nome' => 'Dentista especialista em odontogeriatria',
            ),
            array(
                'nome' => 'Odontopediatra',
            ),
            array(
                'nome' => 'Odontologista em saúde coletiva',
            ),
            array(
                'nome' => 'Odontologista do trabalho',
            ),
            array(
                'nome' => 'Odontologista legal',
            ),
            array(
                'nome' => 'Radiologista',
            ),
        ];

        foreach($especialidades as $especialidade ){
            Especialidades::updateOrCreate(
                $especialidade
            );
        }
    }
}
