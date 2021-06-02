<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Iva;

class Ivas
{
    static $composed;

    public function __construct(Iva $ivas)
    {
        $this->ivas = $ivas;
    }

    public function compose(View $view)
    {
        if(static::$composed)
        {
            return $view->with('ivas', static::$composed);
        }

        static::$composed = $this->ivas->orderBy('name', 'asc')->get();

        $view->with('ivas', static::$composed);
    }
}