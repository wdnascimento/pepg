<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setors')->insert([
            [
                'titulo' => 'DISED',
                'atendimento_online' => 1,
                'responsavel' => 'Luiz',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'ENFERMARIA',
                'atendimento_online' => 1,
                'responsavel' => 'JAQUELINE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'JURÍDICA',
                'atendimento_online' => 1,
                'responsavel' => 'DEFENSORIA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'ALMOXARIFADO',
                'atendimento_online' => 1,
                'responsavel' => 'MONITORES',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'DENTISTA',
                'atendimento_online' => 1,
                'responsavel' => 'ENFERMAGEM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'LAVANDERIA',
                'atendimento_online' => 1,
                'responsavel' => 'MONITORES',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'SERVIÇO SOCIAL',
                'atendimento_online' => 1,
                'responsavel' => 'MONITORES',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
