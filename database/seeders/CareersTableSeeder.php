<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;

class CareersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $careers = [
            'Ing. en Sistemas Computacionales',
            'Ing. en Inteligencia Artificial',
            'Lic. en Ciencia de Datos',
            'Ing. en Sistemas Automotrices',
            'M. en C. en Sistemas Computacionales Moviles'
        ];
        
        foreach($careers as $careerName){
            Career::create([
                'name' => $careerName

            ]);
        }
        
    }
}
