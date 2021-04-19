<?php
namespace App\Models\DB;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $guarded = [];

    protected $table = "t_users";

    public function faqs()
    {
        return $this->hasMany(Login::class, 'login_id');
    }


}
