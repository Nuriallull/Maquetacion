<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Http\Requests\Admin\MueblesRequest;
use App\Vendor\Locale\Locale;
use App\Vendor\Locale\LocaleSlugSeo;
use App\Vendor\Image\Image;
use App\Models\DB\Mueble;
use App\Vendor\Product\Product;
use Debugbar;



class MuebleController extends Controller
{
    protected $mueble;
    protected $agent;
    protected $locale;
    protected $product;
    protected $locale_slug_seo;
    protected $image;
    protected $paginate;

    function __construct(Mueble $mueble, Agent $agent, Locale $locale, LocaleSlugSeo $locale_slug_seo, Image $image, Product $product)
    {
        $this->middleware('auth');
        $this->agent = $agent;
        $this->locale = $locale;
        $this->locale_slug_seo = $locale_slug_seo;
        $this->image = $image;
        $this->mueble = $mueble;
        $this->product = $product;
        $this->mueble->visible = 1;

        if ($this->agent->isMobile()) {
            $this->paginate = 10;
        }

        if ($this->agent->isDesktop()) {
            $this->paginate = 6;
        }
        
       $this->locale->setParent('muebles');
       $this->locale_slug_seo->setParent('muebles');
       $this->image->setEntity('muebles');
       $this->product->setEntity('muebles');
    }
    
    public function index()
    {

        $view = View::make('admin.muebles.index')
                ->with('mueble', $this->mueble)
                ->with('muebles', $this->mueble->where('active', 1)
                ->orderBy('created_at', 'desc')
                ->paginate($this->paginate));

        if(request()->ajax()) {
            
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

        $view = View::make('admin.muebles.index')
        ->with('mueble', $this->mueble)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(MueblesRequest $request)
    {            
        
        $mueble = $this->mueble->updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'active' => 1,
            'mueble_categoria_id' => request('mueble_categoria_id'),
            'color_id' => request('color_id'),
            'tamaño_id' => request('tamaño_id'),
        ]);

        if (request('id')){
            $message = \Lang::get('admin/muebles.faq-update');
        }else{
            $message = \Lang::get('admin/muebles.faq-create');
        }

        if(request('locale')){
            $locale = $this->locale->store(request('locale'), $mueble->id);
        }

        if(request('images')){
            $images = $this->image->store(request('images'), $mueble->id);
        }

        if(request('seo')){
            $seo = $this->locale_slug_seo->store(request('seo'), $mueble->id, 'front_faq');
        }

        if(request('product')){
            $product = $this->product->store(request('product'), $mueble->id, 'front_faq');
        }
            
        $view = View::make('admin.muebles.index')
        ->with('muebles', $this->mueble->where('active', 1)->paginate($this->paginate))
        ->with('mueble', $mueble)
        ->with('locale', $locale)
        ->with('product', $product)
        ->renderSections();         
            

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'message' => $message,
            'id' => $mueble->id,
            'color' => $mueble->color_id,
        ]);
    }

    public function edit(Mueble $mueble)
    {
    
        $locale = $this->locale->show($mueble->id);
        $seo = $this->locale_slug_seo->show($mueble->id);
        //* $product = $this->product->show($mueble->id);

        $view = View::make('admin.muebles.index')
        ->with('locale', $locale)
         //* ->with('product', $product)
        ->with('seo', $seo)
        ->with('mueble', $mueble)
        ->with('muebles', $this->mueble->where('active', 1)->paginate($this->paginate));   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 

    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function show(Mueble $mueble){

        $view = View::make('admin.muebles.index')
        ->with('mueble', $mueble)
        ->with('muebles', $this->mueble->where('active', 1)->orderBy('created_at', 'desc')->paginate($this->paginate))
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
        ]);
    }

    public function destroy(Mueble $mueble)
    {
        $mueble->active = 0;
        $mueble->save();
        $this->locale->delete($mueble->id);
        $this->locale_slug_seo->delete($mueble->id);

        $message = \Lang::get('admin/muebles.faq-delete');

        $view = View::make('admin.muebles.index')
            ->with('mueble', $this->mueble)
            ->with('muebles', $this->mueble->where('active', 1)->paginate($this->paginate))
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'message' => $message
        ]);
    }


    public function filter(Request $request, $filters = null){

        $filters = json_decode($request->input('filters'));

        $query = $this->mueble->query();

        if($filters != null){

            $query->when($filters->mueble_categoria_id, function ($q, $mueble_categoria_id) {

                if($mueble_categoria_id == 'all'){
                    return $q;
                }
                else {
                    return $q->where('mueble_categoria_id', $mueble_categoria_id);
                }
            });

            $query->when($filters->search, function ($q, $search) {
                
                if($search == null){
                    return $q;
                }
                else {
                    return $q->where('t_muebles.name', 'like', "%$search%");
                }
            }); 

            $query->when($filters->created_at_from, function ($q, $created_at_from) {
                
                if($created_at_from == null){
                    return $q;
                }
                else {
                    return $q->whereDate('t_muebles.created_at', '>=', $created_at_from);
                }
            });
            
            $query->when($filters->created_at_since, function ($q, $created_at_since) {
                
                if($created_at_since == null){
                    return $q;
                }
                else {
                    return $q->whereDate('t_muebles.created_at', '<=', $created_at_since);
                }
            });

            $query->when($filters->order, function ($q, $order) use ($filters) {
    
                $q->orderBy($order, $filters->direction);
            });
        }
       

        if($this->agent->isMobile()){
            $muebles = $query->where('t_muebles.active', 1)
            ->orderBy('t_muebles.created_at', 'desc')
            ->paginate(10)
            ->appends(['filters' => json_encode($filters)]);  
        }

        if($this->agent->isDesktop()){
            $muebles = $query->where('t_muebles.active', 1)
            ->orderBy('t_muebles.created_at', 'desc')
            ->paginate(10)
            ->appends(['filters' => json_encode($filters)]);  
        }

        $view = View::make('admin.muebles.index')
            ->with('muebles', $muebles)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]); 
            
       
    }
}
