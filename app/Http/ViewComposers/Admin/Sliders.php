<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\Slider as Slider;

class Sliders
{
    public $sliders;

    public function __construct()
    {
        $this->sliders = Slider::where('active', 1)->orderBy('name', 'asc')->get();
    }

    public function compose(View $view)
    {
        $view->with('sliders', $this->sliders);
    }
}