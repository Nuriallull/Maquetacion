<?php
namespace App\Models\DB;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class Client extends DBModel
{
    use Notifiable;

    protected $guarded = [];

    protected $table = "t_clients";

    public function faqs()
    {
        return $this->hasMany(Login::class, 'login_id');
    }


}
