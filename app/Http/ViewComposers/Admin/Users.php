<?php

namespace App\Http\ViewComposers\Admin;

use Illuminate\View\View;
use App\Models\DB\User as User;

class Users
{
    public $users;

    public function __construct()
    {
        $this->users = User::where('active', 1)->orderBy('name', 'asc')->get();
    }

    public function compose(View $view)
    {
        $view->with('users', $this->users);
    }
}