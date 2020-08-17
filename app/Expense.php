<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['date','user_id'];
    //
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
