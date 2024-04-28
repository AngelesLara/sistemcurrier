<?php

namespace Database\Seeders;

use App\Models\TipoCliente;
use Illuminate\Database\Seeder;
class TipoclienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoCliente::insert([
            [
                'tpcNombre' => 'PERSONA'
            ],
            [
                'tpcNombre' => 'EMPRESA'
            ]
        ]);
    }
}
