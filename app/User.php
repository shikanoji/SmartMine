<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];


    /***
     * @param $role
     * @return mixed
     */
    public function hasRole($role)
    {
        return ($this->role == $role);
    }

    public function getRole(){
        switch($this->role) {
            case 'ROLE_ADMIN': 
                return 'Quản trị';
                break;
            case 'ROLE_MEMBER': 
                return 'Nguời dùng thường';
                break;
            case 'ROLE_SALER':
                return 'Giao dịch viên';
                break;
            default:
                return "Không rõ";
        }
    }

    public function hasAdminPermission() {
        switch($this->role) {
            case 'ROLE_ADMIN': 
                return true;
                break;
            default:
                return false;
        }
    }

    public function hasSalerPermission(){
        switch($this->role) {
            case 'ROLE_ADMIN': 
                return true;
                break;
            case 'ROLE_SALER':
                return true;
                break;
            default:
                return false;
        }
    }

}
