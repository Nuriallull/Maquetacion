<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\LoginRequest;
use App\Models\DB\Login;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $login;
    protected $redirectTo = '/admin/faqs';

   public function __construct(Login $login)

    {   
        $this->middleware('guest', ['except' => ['logout', 'userLogout']]);   

        $this->login = $login;
    }

    public function index()
    {

        return view('front.login.index');

    }

    public function login(LoginRequest $request)
    {

        if ($this->hasTooManyLoginAttempts($request)) {

            $this->fireLockoutEvent($request);
            
            return $this->sendLockoutResponse($request);
        }
       
        if ($this->attemptLogin($request)) {

            if (Auth::guard('web')->user()->active) {

                $this->login->updateOrCreate([
                    'id' => request('id')],[
                    'user_id' =>  Auth::id(),
                    'action' => 'login'
                ]);

                return $this->sendLoginResponse($request);
            }else {
                Auth::guard('web')->logout();
                $request->session()->invalidate();

                return redirect()->route('front_login_submit');
            } 
        }
        
        return $this->sendFailedLoginResponse($request);
    }


    public function store(LoginRequest $request)
    {

        $login = Login::updateOrCreate([
            'id' => request('id')],[
            'user_id' =>  Auth::id(),
            'action' => 'login'
        ]);

        $view = View::make('front.login.index')
        ->with('login', $login)
        ->renderSections();

        return response()->json([
            'form' => $view['form'],
            'id' => $login->id        
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        $this->login->updateOrCreate([
            'id' => request('id')],[
            'user_id' =>  Auth::id(),
            'action' => 'logout'
        ]);

        return redirect('/');
    }
}
    

