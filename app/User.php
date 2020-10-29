<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable{
    //use Notifiable;
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','lastName','email','phone','idRol',
        'password','confirmation_password','status',
    ];
    
    protected $hidden = [
        'password','confirmation_password','remember_token',
    ];

    public function ubications(){
        return $this->hasMany('App\Ubication');
    }

    public function accounts(){
        return $this->hasMany('App\Account');
    }

}

