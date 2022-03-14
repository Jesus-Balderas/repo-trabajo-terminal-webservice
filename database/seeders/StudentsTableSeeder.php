<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
        'num_boleta' => '2014040126',
        'name' => 'Jesus Francisco',
        'first_name' => 'Balderas',
        'second_name' => 'Vargas',
        'email' => 'jesus@gmail.com',
        'password' => bcrypt('jesus123'),
        'career_id'=> 1
        ]);
        Student::create([
            'num_boleta' => '2016601870',
            'name' => 'Daniel',
            'first_name' => 'Aguilar',
            'second_name' => 'Gonzalez',
            'email' => 'daniel@gmail.com',
            'password' => bcrypt('daniel123'),
            'career_id'=> 1
        ]);
        Student::create([
            'num_boleta' => '2014630015',
            'name' => 'Abraham',
            'first_name' => 'Alfaro',
            'second_name' => 'Sosa',
            'email' => 'abraham@gmail.com',
            'password' => bcrypt('abraham123'),
            'career_id'=> 1
        ]);

        Student::create([
            'num_boleta' => '2016630012',
            'name' => 'Julio Cesar',
            'first_name' => 'Aponte',
            'second_name' => 'Del Angel',
            'email' => 'julio@gmail.com',
            'password' => bcrypt('julio123'),
            'career_id'=> 1
        ]);
        
        Student::create([
            'num_boleta' => '2017630281',
            'name' => 'Roberto Armando',
            'first_name' => 'Castro',
            'second_name' => 'Reyna',
            'email' => 'roberto@gmail.com',
            'password' => bcrypt('roberto123'),
            'career_id'=> 1
        ]);
    }
}
