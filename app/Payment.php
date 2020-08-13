<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;
use App\User;
class Payment extends Model
{
    public $timestamps = false;
    //
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeUserId($query, $request)
    {
        if ($request->user_id != '0') {
            $query->where('user_id', $request->user_id);
        }

        return $query;
    }

    public function scopeCustomerId($query, $request)
    {
        if ($request->customer_id != '0') {
            $query->where('customer_id', $request->customer_id);
        }

        return $query;
    }

    public function scopeDate($query, $request)
    {
        if ($request->from_date != '') {
            $query->where('date', '>=', $request->from_date);
        }
        if ($request->to_date != '') {
            $query->where('date', '<=', $request->to_date);
        }
        return $query;
    }
}
