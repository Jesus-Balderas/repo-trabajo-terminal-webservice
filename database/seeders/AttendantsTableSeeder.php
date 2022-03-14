<?php

namespace Database\Seeders;

use App\Models\Attendant;
use Illuminate\Database\Seeder;

class AttendantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attendant::create([
            'num_empleado' => 'E1001',
            'name' => 'Marco Antonio',
            'first_name' => 'Tenorio',
            'second_name' => 'Marron',
            'email' => 'marco@gmail.com',
            'password' => bcrypt('marco123')
        ]);
        Attendant::create([
            'num_empleado' => 'E2002',
            'name' => 'Carlos Jesus',
            'first_name' => 'Pastrana',
            'second_name' => 'Fernandez',
            'email' => 'carlos@gmail.com',
            'password' => bcrypt('carlos123')
        ]);
        Attendant::create([
            'num_empleado' => 'E3003',
            'name' => 'Ricardo',
            'first_name' => 'Martinez',
            'second_name' => 'Rosales',
            'email' => 'ricardo@gmail.com',
            'password' => bcrypt('ricardo123')
        ]);
        Attendant::create([
            'num_empleado' => 'E4004',
            'name' => 'Fabian',
            'first_name' => 'Tenorio',
            'second_name' => 'Marron',
            'email' => 'fabian@gmail.com',
            'password' => bcrypt('marco123')
        ]);
        Attendant::create([
            'num_empleado' => 'E5005',
            'name' => 'Odette Berenice',
            'first_name' => 'Cancino',
            'second_name' => 'Mosqueda',
            'email' => 'odette@gmail.com',
            'password' => bcrypt('odette123')
        ]);
        Attendant::create([
            'num_empleado' => 'E6006',
            'name' => 'Myriam Noemi',
            'first_name' => 'Paredes',
            'second_name' => 'Cadena',
            'email' => 'myriam@gmail.com',
            'password' => bcrypt('myriam123')
        ]);
        Attendant::create([
            'num_empleado' => 'E7007',
            'name' => 'Gloria Lourdes',
            'first_name' => 'Cabrea',
            'second_name' => 'Sanchez',
            'email' => 'gloria@gmail.com',
            'password' => bcrypt('gloria123')
        ]);
    }
}
