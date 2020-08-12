<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    //
    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function getTotalOrderValue() {
        $total_value = 0;
        foreach ($this->orders as $order) {
            $total_value = $total_value + $order->charge;
        }
        return $total_value;
    }

}
