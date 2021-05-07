<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\DB\Faq;
use Debugbar;

class FaqController extends Controller
{
    protected $faq;
    protected $agent;
    protected $paginate;

    function __construct(Faq $faq, Agent $agent)
    {
        $this->middleware('auth');
        $this->faq = $faq;
        $this->agent = $agent;
        
    }
    
    public function index()
    {

        $view = View::make('admin.faqs.index')
                ->with('faq', $this->faq)
                ->with('faqs', $this->faq->where('active', 1)
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

        $view = View::make('admin.faqs.index')
        ->with('faq', $this->faq)
        ->renderSections();

        return response()->json([
            'form' => $view['form']
        ]);
    }

    public function store(FaqRequest $request)
    {            
        Debugbar::info(request('locale'));

        $faq = $this->faq->updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'active' => 1,
            'category_id' => request('category_id'),
        ]);

        if (request('id')){
            $message = \Lang::get('admin/faqs.faq-update');
        }else{
            $message = \Lang::get('admin/faqs.faq-create');
        }

            $view = View::make('admin.faqs.index')
            ->with('faqs', $this->faq->where('active', 1)->paginate($this->paginate))
            ->with('faq', $faq)
            ->renderSections();        
        

            $view = View::make('admin.faqs.index')
            ->with('faqs', $this->faq->where('active', 1)->paginate($this->paginate))
            ->with('faq', $faq)
            ->renderSections();        
             

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'message' => $message,
            'id' => $faq->id,
        ]);
    }

    public function edit(Faq $faq)
    {
        $view = View::make('admin.faqs.index')
        ->with('faq', $faq)
        ->with('faqs', $this->faq->where('active', 1)->paginate($this->paginate));   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function show(Faq $faq){

        $view = View::make('admin.faqs.index')
        ->with('faq', $faq)
        ->with('faqs', $this->faq->where('active', 1)->orderBy('created_at', 'desc')->paginate($this->paginate))
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
        ]);
    }

    public function destroy(Faq $faq)
    {
        $faq->active = 0;
        $faq->save();

        $view = View::make('admin.faqs.index')
            ->with('faq', $this->faq)
            ->with('faqs', $this->faq->where('active', 1)->paginate($this->paginate))
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }


    public function filter(Request $request, $filters = null){

        $filters = json_decode($request->input('filters'));

        $query = $this->faq->query();

        if($filters != null){

            $query->when($filters->category_id, function ($q, $category_id) {

                if($category_id == 'all'){
                    return $q;
                }
                else {
                    return $q->where('category_id', $category_id);
                }
            });

            $query->when($filters->search, function ($q, $search) {
                
                if($search == null){
                    return $q;
                }
                else {
                    return $q->where('t_faqs.name', 'like', "%$search%");
                }
            }); 

            $query->when($filters->created_at_from, function ($q, $created_at_from) {
                
                if($created_at_from == null){
                    return $q;
                }
                else {
                    return $q->whereDate('t_faqs.created_at', '>=', $created_at_from);
                }
            });
            
            $query->when($filters->created_at_since, function ($q, $created_at_since) {
                
                if($created_at_since == null){
                    return $q;
                }
                else {
                    return $q->whereDate('t_faqs.created_at', '<=', $created_at_since);
                }
            });

            $query->when($filters->order, function ($q, $order) use ($filters) {
    
                $q->orderBy($order, $filters->direction);
            });
        }
       

        if($this->agent->isMobile()){
            $faqs = $query->where('t_faqs.active', 1)
            ->orderBy('t_faqs.created_at', 'desc')
            ->paginate(10)
            ->appends(['filters' => json_encode($filters)]);  
        }

        if($this->agent->isDesktop()){
            $faqs = $query->where('t_faqs.active', 1)
            ->orderBy('t_faqs.created_at', 'desc')
            ->paginate(10)
            ->appends(['filters' => json_encode($filters)]);  
        }

        $view = View::make('admin.faqs.index')
            ->with('faqs', $faqs)
            ->renderSections();

        return response()->json([
            'table' => $view['table'],
        ]); 
            
       
    }
}
