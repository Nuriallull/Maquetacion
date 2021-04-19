<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Models\DB\Client;

class ClientController extends Controller
{
    function __construct(Client $client)

    {  
       $this->middleware('auth');      
        $this->client = $client;
    }

    public function index()
    {

        $view = View::make('admin.clients.index')
                ->with('clients', $this->client->where('active', 1)->get())
                ->with('client', $this->client);
    
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

        $view = View::make('admin.clients.index')
        ->with('client', $this->client)
        ->renderSections();

        return response()->json([
            'form' => $view['form'],
        ]);
    }

    public function store(ClientRequest $request)
    {
        if (request('password') !== null) {

            $client = Client::updateOrCreate([
                'id' => request('id')],[
                'name' => request('name'),
                'surname' => request('surname'),
                'address' => request('address'),
                'location' => request('location'),
                'country_id' =>request('country_id'),
                'zip' => request('zip'),
                'email' => request('email'),
                'password' => bcrypt(request('password')),
                'active' => 1,
            ]);
        }else{
           
            $client = Client::updateOrCreate([
                'id' => request('id')],[
                'name' => request('name'),
                'surname' => request('surname'),
                'address' => request('address'),
                'location' => request('location'),
                'country_id' =>request('country_id'),
                'zip' => request('zip'),
                'email' => request('email'),
                'active' => 1,
            ]);
        }

        $view = View::make('admin.clients.index')
        ->with('clients', $this->client->where('active', 1)->get())
        ->with('client', $client)
        ->renderSections();

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $client->id        
        ]);
       
    }



    public function edit(Client $client)
    {
                
        $view = View::make('admin.clients.index')
        ->with('client', $client)
        ->with('clients', $this->client->where('active', 1)->get());

        
        if(request()->ajax()) {
            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function show(Client $client)
    {

    }

    public function destroy(Client $client)
    {   
        $client->active = 0;
        $client->save();

        $view = View::make('admin.clients.index')
        ->with('clients', $this->client->where('active', 1)->get())
        ->with('client', $this->client)
        ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
        ]);
    }
}
