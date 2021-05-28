<?php

namespace App\Models\DB;

use App\Vendor\Locale\Models\Locale;
use App\Vendor\Locale\Models\LocaleSlugSeo;
use App\Vendor\Image\Models\ImageResized;
use App;

class Mueble extends DBModel
{

    protected $table = 't_muebles';
    protected $with = ['category'];

    public function category()
    {
        return $this->belongsTo(MueblesCategory::class, 'mueble_categoria_id');
    }
    
    public function locale()
    {
        return $this->hasMany(Locale::class, 'key')->where('rel_parent', 'muebles')->where('language', App::getLocale());
    }

    public function seo()
    {
        return $this->hasOne(LocaleSlugSeo::class, 'key')->where('rel_parent', 'muebles')->where('language', App::getLocale());
    }

    public function images_featured_preview()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('grid', 'preview')->where('content', 'featured')->where('entity', 'muebles');
    }

    public function image_featured_desktop()
    {
        return $this->hasOne(ImageResized::class, 'entity_id')->where('grid', 'desktop')->where('content', 'featured')->where('entity', 'muebles')->where('language', App::getLocale());
    }

    public function image_featured_mobile()
    {
        return $this->hasOne(ImageResized::class, 'entity_id')->where('grid', 'mobile')->where('content', 'featured')->where('entity', 'muebles')->where('language', App::getLocale());
    }

    public function images_grid_preview()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('grid', 'preview')->where('content', 'grid')->where('entity', 'muebles');
    }

    public function image_grid_desktop()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('grid', 'desktop')->where('content', 'grid')->where('entity', 'muebles')->where('language', App::getLocale());
    }

    public function image_grid_mobile()
    {
        return $this->hasMany(ImageResized::class, 'entity_id')->where('grid', 'mobile')->where('content', 'grid')->where('entity', 'muebles')->where('language', App::getLocale());
    }

    public function colors()
    {
        return $this->hasMany(Colors::class, 'key')->where('rel_parent', 'muebles')->where('language', App::getLocale());
    }

    public function tamaños()
    {
        return $this->hasMany(Tamaños::class, 'key')->where('rel_parent', 'muebles')->where('language', App::getLocale());
    }

}
