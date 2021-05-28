<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Colors;

class Colores
{
    static $composed;

    public function __construct(Colors $colors)
    {
        $this->colors = $colors;
    }

    public function compose(View $view)
    {
        if(static::$composed)
        {
            return $view->with('colors', static::$composed);
        }

        static::$composed = $this->colors->orderBy('name', 'asc')->get();

        $view->with('colors', static::$composed);
    }
}