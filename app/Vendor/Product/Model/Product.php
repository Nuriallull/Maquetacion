<?php

namespace App\Vendor\Product\Model;

use Illuminate\Database\Eloquent\Model;
use Debugbar;

class Product extends Model
{
    protected $table = 't_product';
    protected $guarded = [];

    public function scopeGetValues($query, $entity, $key){

        return $query->where('key', $key)
            ->where('entity', $entity);
    }

}
