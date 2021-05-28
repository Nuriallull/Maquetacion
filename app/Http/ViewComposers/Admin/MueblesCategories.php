<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\MueblesCategory;

class MueblesCategories
{

    static $composed;

    public function __construct(MueblesCategory $muebles_categories)
    {
        $this->muebles_categories = $muebles_categories;
    }

    public function compose(View $view)
    {

        if(static::$composed)
        {
            return $view->with('muebles_categories', static::$composed);
        }

        static::$composed = $this->muebles_categories->where('active', 1)->orderBy('name', 'asc')->get();

        $view->with('muebles_categories', static::$composed);

    }
}