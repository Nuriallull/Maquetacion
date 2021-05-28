<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DB\Tamaños;

class TamañoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$tamaños = array(
			['dimensions' => "232x100", 'name' => "lounge"], 
			['dimensions' => "204x100", 'name' => "sofá tres plazas"],
			['dimensions' => "172x100", 'name' => "sofá dos plazas"],
			['dimensions' => "280x165", 'name' => "chaise lounge 2 plazas"],
			['dimensions' => "270x165", 'name' => "sofá cuatro plazas"],
			['dimensions' => "280x100x165", 'name' => "chaise lounge 3 plazas"],
		
		);
 
		foreach ($tamaños as $tamaño){

			Tamaños::create([
				'dimensions' => $tamaño['dimensions'],
				'name' => $tamaño['name']
			]);
		}

    }
}
