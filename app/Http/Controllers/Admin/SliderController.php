<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\DB\Slider;

class SliderController extends Controller
{
    function __construct(Slider $slider)

    {      
        $this->slider = $slider;
    }

    public function index()
    {

        $view = View::make('admin.sliders.index')
            ->with('sliders', $this->slider->where('active', 1)->paginate(4))
            ->with('slider', $this->slider);
    
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

        $view = View::make('admin.sliders.index')
        ->with('slider', $this->slider)
        ->with('sliders', $this->slider->where('active', 1)->paginate(4))
        ->renderSections();

        return response()->json([
            'form' => $view['form'],
        ]);
    }

    public function store(SliderRequest $request)
    {            
        $slider = $this->slider->updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'entity' => request('entity'),
            'visible' => 1,
            'active' => 1,
        ]);

        if (request('id')){
            $message = \Lang::get('admin/faqs.faq-update');
        }else{
            $message = \Lang::get('admin/faqs.faq-create');
        }

            $view = View::make('admin.sliders.index')
            ->with('sliders', $this->slider->where('active', 1)->paginate(10))
            ->with('slider', $slider)
            ->renderSections();        
        

            $view = View::make('admin.sliders.index')
            ->with('sliders', $this->slider->where('active', 1)->paginate(6))
            ->with('slider', $slider)
            ->renderSections();        
             

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'message' => $message,
            'id' => $slider->id,
        ]);
    }



    public function edit(Slider $slider)
    {
                
        $view = View::make('admin.sliders.index')
        ->with('slider', $slider)
        ->with('sliders', $this->slider->where('active', 1)->paginate(5));

        
        if(request()->ajax()) {
            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function show(Slider $slider)
    {

    }

    public function destroy(Slider $slider)
    {   
        $slider->active = 0;
        $slider->save();

        $view = View::make('admin.sliders.index')
        ->with('sliders', $this->slider->where('active', 1)->paginate(5))
        ->with('slider', $this->slider)
        ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
        ]);
    }


    public function filter(Request $request){

        $query = $this->slider->query();

        $query->when(request('search'), function ($q, $search) {
            
            if($search == null){
                return $q;
            }
            else {
                return $q->where('name', 'like', "%$search%");
            }
        }); 

        $query->when(request('created_at_from'), function ($q, $created_at_from) {
            
            if($created_at_from == null){
                return $q;
            }
            else {
                return $q->whereDate('created_at', '>=', $created_at_from);
            }
        });
        
        $query->when(request('created_at_since'), function ($q, $created_at_since) {
            
            if($created_at_since == null){
                return $q;
            }
            else {
                return $q->whereDate('created_at', '<=', $created_at_since);
            }
        });

        // Aqui va la parte en la que introducimos el filtro Order By. También indicamos la forma en la que vamos a ordenar (direction)
        $query->when(request('order_by'), function ($q, $order_by) {

            return $q->orderBy($order_by, request('direction'));
            
        });

        $sliders = $query->where('active', 1)->paginate(5);

        $view = View::make('admin.sliders.index')
            ->with('sliders', $sliders);

        if(request()->ajax()) {
            
                $sections = $view->renderSections(); 
        
                return response()->json([
                    'table' => $sections['table'],
                ]); 
        }
    
        return $view;
        
    }
    
}
