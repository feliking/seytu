<?php

use Illuminate\Database\Seeder;

use App\Models\Departamento;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "nombre" => "La Paz"
            ],
            [
                "nombre" => "Cochabamba"
            ],
            [
                "nombre" => "Santa Cruz"
            ],
            [
                "nombre" => "Oruro"
            ],
            [
                "nombre" => "Beni"
            ],
            [
                "nombre" => "Pando"
            ],
            [
                "nombre" => "Chuquisaca"
            ],
            [
                "nombre" => "Tarija"
            ],
            [
                "nombre" => "Potosi"
            ]
        ];
        foreach($data as $data){
            Departamento::create($data);
        }
    }
}
