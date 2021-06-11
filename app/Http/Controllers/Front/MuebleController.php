<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Vendor\Locale\LocaleSlugSeo;
use App\Models\DB\Mueble;

class MuebleController extends Controller
{
    protected $agent;
    protected $mueble;
    protected $locale_slug_seo;

    function __construct(Agent $agent, Mueble $mueble, LocaleSlugSeo $locale_slug_seo)
    {
        $this->agent = $agent;
        $this->mueble = $mueble;
        $this->locale_slug_seo = $locale_slug_seo;

        $this->locale_slug_seo->setLanguage(app()->getLocale()); 
        $this->locale_slug_seo->setParent('muebles');      
    }

    public function index()
    {   
        $seo = $this->locale_slug_seo->getByKey(Route::currentRouteName());

        if($this->agent->isDesktop()){

            $muebles = $this->mueble
                    ->with('image_featured_desktop')
                    ->where('active', 1)
                    ->get();
        }
        
        elseif($this->agent->isMobile()){
            $muebles = $this->mueble
                    ->with('image_featured_mobile')
                    ->where('active', 1)
                    ->get();
        }

        $muebles = $muebles->each(function($mueble){  
            
            $mueble['locale'] = $mueble->locale->pluck('value','tag');
            
            return $mueble;
        });

        $view = View::make('front.pages.muebles.index')
                ->with('muebles', $muebles) 
                ->with('seo', $seo );


            if(request()->ajax()) {

                $sections = $view->renderSections(); 
        
                return response()->json([
                    'view' => $sections['content'],
                ]); 
            }

        return $view;
    }

    public function show($slug)
    {      
        $seo = $this->locale_slug_seo->getIdByLanguage($slug);

        if(isset($seo->key)){

            if($this->agent->isDesktop()){
                $mueble = $this->mueble
                    ->with('image_featured_desktop')
                    ->with('image_grid_desktop')
                    ->where('active', 1)
                    ->find($seo->key);
            }
            
            elseif($this->agent->isMobile()){
                $mueble = $this->mueble
                    ->with('image_featured_mobile')
                    ->with('image_grid_mobile')
                    ->where('active', 1)
                    ->find($seo->key);
            }

            $mueble['locale'] = $mueble->locale->pluck('value','tag');

            $view = View::make('front.pages.muebles.single')->with('mueble', $mueble);

            return $view;

        }else{
            return response()->view('errors.404', [], 404);
        }
    }
}
