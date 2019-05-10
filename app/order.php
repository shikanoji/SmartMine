<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;
use App\charge;
class order extends Model
{
    public $timestamps = false;

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function charges(){
        return $this->hasMany(charge::class);
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
            case 'failed':
                return "Trật";
            case 'success':
                return "Ăn";    
            default:
                return "Ăn ".substr($this->status,7)." Nháy";
        }
    }

   public function getRewardMoney(){
       switch($this->type) {
            case 'D':
                return $this->sotien * $this->customer->rateD ;
            case  'L':
                return $this->sotien * $this->customer->rateL;
            case  'BC':
                return $this->sotien * $this->customer->rateBC;
            case  'L2':
                return $this->sotien * $this->customer->rateLx2;;
            case  'L3':
                return $this->sotien * $this->customer->rateLx3;
            case  'L4':
                return $this->sotien * $this->customer->rateLx4;
            default:
                return 0;
        }
   } 
}
