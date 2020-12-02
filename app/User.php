<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    //use Notifiable;
    use HasApiTokens, Notifiable;

    protected $table = 'tbl_usuarios';
    protected $primaryKey = 'idUsuario';

    protected $fillable = [
        'name','lastName','email','phone','idRol',
        'password','confirmation_password','status',
    ];

    protected $hidden = [
        'password','confirmation_password','remember_token',
    ];

    public function scopeGetUsuarios($query,$like,$estatus) {
        return $query
            ->tblRoles()
            ->getUsuariosLike($like)
            ->orderBy('tbl_usuarios.created_at','desc')
            ->where('tbl_usuarios.eliminado',$estatus)
            ->getAttributes();

    }

    public function scopeGetUsuario($query,$idUsuario) {
        return $query->getAttributes()->findOrFail($idUsuario);
    }

    public function scopeTblRoles($query) {
        return $query->join('tbl_roles','tbl_usuarios.idRol','tbl_roles.idRol');
    }

    public function scopeGetUsuariosLike($query,$like) {
        return $query->where('tbl_usuarios.name',"LIKE","%{$like}%")
            ->orWhere('tbl_usuarios.lastName',"LIKE","%{$like}%")
            ->orWhere('tbl_usuarios.phone',$like);
    }

    public function scopeGetUsuariosByRol($query,$rol) {
        return $query->where('tbl_roles.rol',$rol);
    }

    public function scopeGetAttributes($query) {
        return $query->select(
            'tbl_usuarios.idUsuario',
            'tbl_usuarios.name as nombreRepartidor',
            'tbl_usuarios.lastName as apellidoRepartidor',
            'tbl_usuarios.phone as telefonoRepartidor',
            'tbl_usuarios.created_at as fechaRegistroRepartidor'
        );
    }



}
