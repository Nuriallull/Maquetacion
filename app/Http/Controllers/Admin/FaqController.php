<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\DB\Faq;

class FaqController extends Controller
{
    protected $faq;

    function __construct(Faq $faq)
    {
       $this->middleware('auth');
        $this->faq = $faq;
        
    }
    
    public function index()
    {

        $view = View::make('admin.faqs.index')
                ->with('faq', $this->faq)
                ->with('faqs', $this->faq->where('active', 1)->paginate(5)); 

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

        $view = View::make('admin.faqs.index')
        ->with('faq', $this->faq)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(FaqRequest $request)
    {            
        $faq = $this->faq->updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'active' => 1,
            'category_id' => request('category_id'),
        ]);

        $view = View::make('admin.faqs.index')
        ->with('faqs', $this->faq->where('active', 1)->paginate(5))
        ->with('faq', $faq)
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $faq->id,
        ]);
    }

    public function edit(Faq $faq)
    {
        $view = View::make('admin.faqs.index')
        ->with('faq', $faq)
        ->with('faqs', $this->faq->where('active', 1)->paginate(5));   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function show(Faq $faq){

    }

    public function destroy(Faq $faq)
    {
        $faq->active = 0;
        $faq->save();

        $view = View::make('admin.faqs.index')
            ->with('faq', $this->faq)
            ->with('faqs', $this->faq->where('active', 1)->paginate(5))
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }


    public function filter(Request $request){

        $query = $this->faq->query();

        $query->when(request('category_id'), function ($q, $category_id) {

            if($category_id == 'all'){
                return $q;
            }
            else {
                return $q->where('category_id', $category_id);
            }
        });

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

        
        $faqs = $query->where('t_faqs.active', 1)->join('t_faqs_categories', 't_faqs.category_id', '=', 't_faqs_categories.id')->get();

        $view = View::make('admin.faqs.index')
            ->with('faqs', $faqs);

        if(request()->ajax()) {
            
                $sections = $view->renderSections(); 
        
                return response()->json([
                    'table' => $sections['table'],
                ]); 
        }
    
        return $view;
    }
}
