<?php

namespace Database\Seeders;

use App\Models\Laboratory;
use Illuminate\Database\Seeder;

class LaboratoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Laboratory::create([
            'name' => 'Laboratorio de Programacion 1',
            'classroom' => '1107',
            'edifice' => '1',
            'computers' => '36',
            'attendant_id' => 1
        ]);
        Laboratory::create([
            'name' => 'Laboratorio de Programacion 2',
            'classroom' => '2106',
            'edifice' => '2',
            'computers' => '36',
            'attendant_id' => 2
        ]);
        Laboratory::create([
            'name' => 'Laboratorio de Redes',
            'classroom' => '1104',
            'edifice' => '1',
            'computers' => '36',
            'attendant_id' => 3
        ]);
        Laboratory::create([
            'name' => 'Laboratorio de Sistemas 1',
            'classroom' => '2105',
            'edifice' => '2',
            'computers' => '36',
            'attendant_id' => 4
        ]);
        Laboratory::create([
            'name' => 'Laboratorio de Sistemas 2',
            'classroom' => '2106',
            'edifice' => '2',
            'computers' => '36',
            'attendant_id' => 5
        ]);
        Laboratory::create([
            'name' => 'Laboratorio de Sistemas 3',
            'classroom' => '1105',
            'edifice' => '1',
            'computers' => '36',
            'attendant_id' => 6
        ]);
        Laboratory::create([
            'name' => 'Laboratorio de Sistemas 4',
            'classroom' => '1106',
            'edifice' => '1',
            'computers' => '36',
            'attendant_id' => 7
        ]);
            
        
    }
}
