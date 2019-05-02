<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;

class order extends Model
{
    public $timestamps = false;

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function getType(){
        switch($this->type) {
            case 'D':
                return "Đề";
            case  'L':
                return "Lô";
            case  'BC':
                return "Ba Càng";
            case  'L2':
                return "Lô xiên 2";
            case  'L3':
                return "Lô xiên 3";
            case  'L4':
                return "Lô xiên 4";
            default:
                return "Không rõ";
        }
    }

    public function getKetQua(){
        switch($this->status) {
            case 'waiting':
                return "Chưa có";
            case  'fail':
                return "Trật";
            case  'success':
                return "Ăn";
            default:
                return "Không rõ";
        }
    }
}
