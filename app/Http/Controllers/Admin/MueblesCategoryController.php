<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MueblesCategoryRequest;
use App\Models\DB\MueblesCategory;

class MueblesCategoryController extends Controller
{

    function __construct(MueblesCategory $muebles_category)
    {   
       $this->middleware('auth');
        $this->muebles_category = $muebles_category;
    }

    public function index()
    {

        $view = View::make('admin.muebles_categories.index')
                ->with('muebles_categories', $this->muebles_category->where('active', 1)->get())
                ->with('muebles_category', $this->muebles_category);
        

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

        $view = View::make('admin.muebles_categories.index')
        ->with('muebles_category', $this->muebles_category)
        ->renderSections();

        return response()->json([
            'form' => $view['form'],
        ]);
    }

    public function store(MueblesCategoryRequest $request)
    {

        $muebles_category = MueblesCategory::updateOrCreate([
            'id' => request('id')],[
            'name' => request('name'),
            'active' => 1,
        ]);



        $view = View::make('admin.muebles_categories.index')
        ->with('muebles_categories', $this->muebles_category->where('active', 1)->get())
        ->with('muebles_category', $muebles_category)
        ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $muebles_category->id        
        ]);
    }

    public function edit(MueblesCategory $muebles_category)
    {
                
        $view = View::make('admin.muebles_categories.index')
        ->with('muebles_category', $muebles_category);
        
        if(request()->ajax()) {
            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function show(MueblesCategory $muebles_category)
    {

    }

    public function destroy(MueblesCategory $muebles_category)
    {   
        $muebles_category->active = 0;
        $muebles_category->save();

        $view = View::make('admin.muebles_categories.index')
        ->with('muebles_categories', $this->muebles_category->where('active', 1)->get())
        ->with('muebles_category', $this->muebles_category)
        ->with('locale', $this->locale->create())
        ->with('crud_permissions', $this->crud_permissions)
        ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
        ]);
    }
}
