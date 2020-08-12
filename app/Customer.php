<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;
use App\Payment;

class Customer extends Model
{
    //
    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function getBalance(){
        $balance = 0;
        $orders = $this->orders()->get();
        foreach ($orders as $order) {           
            $balance = $balance + $order->charge;
        }
        $payments = $this->payments()->get();
        foreach ($payments as $payment) {
            $balance = $balance - $payment->amount;
        }
        return $balance;
    }

    public function getTotalCharge() {
        $total_charge = 0;
        $orders = $this->orders()->get();
        foreach ($orders as $order) {           
            $total_charge = $total_charge + $order->charge;
        }
        return $total_charge;
    }

    public function getTotalPayment() {
        $total_payment = 0;
        $payments = $this->payments()->get();
        foreach ($payments as $payment) {
            $total_payment = $total_payment + $payment->amount;
        }
        return $total_payment;
    }
}
