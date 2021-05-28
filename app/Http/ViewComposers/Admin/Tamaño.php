<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Tamaños;

class Tamaño
{
    static $composed;

    public function __construct(Tamaños $tamaños)
    {
        $this->tamaños = $tamaños;
    }

    public function compose(View $view)
    {
        if(static::$composed)
        {
            return $view->with('tamaños', static::$composed);
        }

        static::$composed = $this->tamaños->orderBy('name', 'asc')->get();

        $view->with('tamaños', static::$composed);
    }
}