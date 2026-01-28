<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'wagnerinfo@policiapenal.pr.gov.br',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => Hash::make('password'),
            'remember_token' => 'remember_token',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

    }
}
