<?php

namespace App\Models\DB;

class Faq extends DBModel
{

    protected $table = 't_faqs';

    public function category()
    {
        return $this->belongsTo(FaqCategory::class);
    }

    //* public function __construct() { $this->faqs_categories = FaqCategory::orderBy('name', 'asc')->get();}
}
