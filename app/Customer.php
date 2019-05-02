<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\order;
use App\charge;
class Customer extends Model
{
    public $timestamps = false;
    //

    public function orders(){
        return $this->hasMany(order::class);
    }

    public function charges(){
        return $this->hasMany(charge::class);
    }

    public function getTaiKhoan(){
        $account = 0;
        $charges = $this->charges()->get();
        foreach ($charges as $charge) {           
            $account = $account + $charge->chargeMoney;
        }
        return $account;
    }
}
