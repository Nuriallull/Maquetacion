<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DB\Colors;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $colors = array("Blanco","Azul Noche","Negro", "Beige", "Rojo Oscuro", "Verde", "Topo", "Marrón", "Amarillo", "Multicolor", "Gris", "Naranja", "Azul Cielo", "Rosa", "Violeta", "Turquesa");

         foreach ($colors as $color){
            Colors::create([
                'name' => $color
              ]);
            }
    }
}
