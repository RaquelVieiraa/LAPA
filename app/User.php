<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','cpf','email','telephone','surname','user_description','avatar','user_type',
    ];

    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function disciplina() {
        return $this->hasMany('App\Disciplina');
    }

    public function postagem() {
        return $this->hasMany('App\Postagem');
    }
    public function conta()
    {
         return $this->hasOne('App\Conta');
    }

}
