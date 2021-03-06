<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Vendor\Locale\Manager;
use App\Http\Controllers\Controller;
use App\Vendor\Locale\Models\LocaleLanguage;
use App\Vendor\Locale\Models\LocaleTag;
use Debugbar;

class LocaleTagController extends Controller 
{
    protected $tag;
    protected $language;
    protected $manager;
    protected $paginate;

    function __construct(Agent $agent, LocaleTag $tag, LocaleLanguage $language,  Manager $manager)

    {  
        $this->middleware('auth');
        $this->agent = $agent;
        $this->tag = $tag;
        $this->tag->active = 1;
        $this->language = $language;
        $this->manager = $manager;
        if ($this->agent->isMobile()) {
            $this->paginate = 10;
        }

        if ($this->agent->isDesktop()) {
            $this->paginate = 6;
        }
    }

    public function index()
    {      
        $tags = $this->tag
                ->select('group', 'key')
                ->groupBy('group', 'key')
                ->where('group', 'not like', 'admin/%')
                ->where('group', 'not like', 'front/seo')
                ->paginate($this->paginate); 
        
        $view = View::make('admin.traductions.index')
            ->with('tag', $this->tag)
            ->with('tags', $tags);

        if(request()->ajax()){

            $sections = $view->renderSections(); 
            
            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]); 
        }

        return $view;
    }

    public function create()
    {


    }

    public function store(Request $request)
    {

        foreach(request('tag') as $rel_anchor => $value){

            $rel_anchor = str_replace(['-', '_'], ".", $rel_anchor); 
            $explode_rel_anchor = explode('.', $rel_anchor);
            $language = end($explode_rel_anchor);

            $tag = $this->tag::updateOrCreate([
                'language' => $language,
                'group' => request('group'),
                'key' => request('key')],[
                'value' => $value,
                'active' => 1
            ]);
        }

        $this->manager->exportTranslations(request('group'));   

        $tags = $this->tag
        ->select('group', 'key')
        ->groupBy('group', 'key')
        ->where('group', 'not like', 'admin/%')
        ->where('group', 'not like', 'front/seo')
        ->paginate($this->paginate);  

        $message = \Lang::get('admin/tags.tag-update');
        
        $view = View::make('admin.traductions.index')
        ->with('tags', $tags)
        ->with('tag', $this->tag)
        ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'message' => $message,     
        ]);
    }


    public function edit($group, $key)
    {

        $tags = $this->tag->where('key', $key)->where('group', str_replace('-', '/' , $group))->paginate($this->paginate); 
        $tag = $tags->first();
        $languages = $this->language->get();

        foreach($languages as $language){
            $locale = $tags->filter(function($item) use($language) {
                return $item->language == $language->alias;
            })->first();

            $tag['value.'. $language->alias] = empty($locale->value) ? '': $locale->value; 
        }
        
        $view = View::make('admin.traductions.index')
        ->with('tag', $tag)
        ->with('tags', $tags);

        
        if(request()->ajax()) {
            $sections = $view->renderSections(); 
    
            return response()->json([
                'table' => $sections['table'],
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function filter(Request $request, $filters = null){

        $filters = json_decode($request->input('filters'));
        
        $query = $this->tag->query();

        if($filters != null){

            $query->when($filters->parent, function ($q, $parent) {

                if($parent == 'all'){
                    return $q;
                }
                else{
                    return $q->where('group', $parent);
                }
            });
    
            $query->when($filters->order, function ($q, $order) use ($filters) {
    
                $q->orderBy($order, $filters->direction);
            });
        }
    
        $tags = $query->select('group', 'key')
                ->groupBy('group', 'key')
                ->where('group', 'not like', 'admin/%')
                ->where('group', 'not like', 'front/seo')
                ->paginate($this->paginate)
                ->appends(['filters' => json_encode($filters)]);  

        $view = View::make('admin.traductions.index')
            ->with('tags', $tags)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]);
    }

    public function importTags()
    {
        $this->manager->importTranslations();  
        $message =  \Lang::get('admin/tags.tag-import');

        $tags = $this->tag
        ->select('group', 'key')
        ->groupBy('group', 'key')
        ->where('group', 'not like', 'admin/%')
        ->where('group', 'not like', 'front/seo')
        ->paginate($this->paginate);  

        $view = View::make('admin.traductions.index')
        ->with('tags', $tags)
        ->with('tag', $this->tag);

        if(request()->ajax()) {

        $sections = $view->renderSections(); 

        return response()->json([
            'table' => $sections['table'],
            'message' => $message,
        ]); 

        }
    }
}
