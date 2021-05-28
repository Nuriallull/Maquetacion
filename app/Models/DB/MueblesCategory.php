<?php

namespace App\Models\DB;

class MueblesCategory extends DBModel
{

    protected $table = 't_muebles_categorias';

    public function faqs()
    {
        return $this->hasMany(Mueble::class, 'mueble_categoria_id');
    }

}

