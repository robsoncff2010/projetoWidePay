<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class RegisterUrl extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'register_url';

    protected $fillable = ['id','user_id', 'url', 'http_status', 'http_body'];

    protected $primaryKey = "id";

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
