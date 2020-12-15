<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Wagner Demetrio do Nascimento',
            'email' => 'wagnerinfo@depen.pr.gov.br',
            'password' => Hash::make('ati@d3p3n'),
        ]);
    }
}
