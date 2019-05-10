<?php
namespace App;
use App\ketqualo;
use App\ketquade;
use Goutte\Client;
use App\order;
use App\charge;

class ScoreHelper {
    public function getTodayScore(){
        $client = new Client();
        $crawler = $client->request('GET', 'https://ketqua.net');
        $ngay = date("Y-m-d",strtotime(substr($crawler->filter('span[id="result_date"]')->eq(0)->text(), -10)));
        if (ketquade::where('ngay', '=', $ngay)->exists()) {
            $de = ketquade::where('ngay', '=', $ngay)->first();           
        }else {
            $de = new ketquade();
        }        
        $de->ngay = $ngay;
        $de->ketqua = $crawler->filter('td')->eq(2)->text();
        $de->save();

        $lotable = $crawler->filter('table[id="loto_mb"]');
        $kqlo = '';
        for($i=1; $i<=3; $i++){
            for($j=0;$j<9;$j++){
                $kqlo = $kqlo . $lotable->filter('tr')->eq($i)->filter('td')->eq($j)->text();
            }
        }
        if (ketqualo::where('ngay', '=', $ngay)->exists()) {
            $lo = ketqualo::where('ngay', '=', $ngay)->first();           
        } else {
            $lo = new ketqualo();
        }        
        $lo->ngay = $ngay;
        $lo->ketqua = $kqlo;
        $lo->save();
        $this->updateOrdersResult($ngay);
    }

    public function updateOrdersResult($ngay){
        $orders = order::where('ngay', '=', $ngay)->get();
        $de = ketquade::where('ngay', '=', $ngay)->first();
        $lo = ketqualo::where('ngay', '=', $ngay)->first();
        $los = str_split($lo->ketqua, 2);
        foreach($orders as $order) {
            switch($order->type) {
                case 'D' :
                    if ($order->code == substr($de->ketqua, -2)) {
                        $order->status = "success";
                    } else {
                        $order->status = "failed";
                    }
                    break;
                case "BC":
                    if ($order->code == substr($de->ketqua, -3)) {
                        $order->status = "success";
                    } else {
                        $order->status = "failed";
                    }
                    break;
                case "L":
                    $count = 0;
                    foreach($los as $lo){
                        if($lo == $order->code){
                            $count = $count+1;
                        }
                    }
                    if($count == 0 ){
                        $order->status = "failed";
                    } else {
                        $order->status = "success".$count;
                    }
                    break;   
                 default: 
                    $records = str_split($order->code, 2);
                    if (count(array_diff($records, $los)) == 0 ) {
                        $order->status = "success";
                    } else {
                        $order->status = "failed";
                    }
                    break;
                   
            }
            $order->save(); 
            $this->updateReward($order);
        }
    }

    public function updateReward($order){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if(substr($order->status, 0, 7) == 'success'){
            if (charge::where('order_id','=', $order->id)->where('note', '=', 'Thưởng thắng')->exists() == false) {
                $rewardcharge = new charge();
            } else {
                $rewardcharge = charge::where('order_id','=', $order->id)->where('note', '=', 'Thưởng thắng')->first();
            }          
            $rewardcharge->user_id  = auth()->id();
            $rewardcharge->customer_id = $order->customer_id;
            $rewardcharge->order_id = $order->id;
            $rewardcharge->created_at = date('Y-m-d H:i:s');
            if( $order->status == 'success'){
                $rewardcharge->chargeMoney = $order->getRewardMoney();
            } else {
                $rewardcharge->chargeMoney = $order->getRewardMoney() * (int)substr($order->status,7);
            }
            $rewardcharge->note = 'Thưởng thắng';
            $rewardcharge->save();
        }    
        if (charge::where('order_id','=', $order->id)->where('note', '=', 'Thưởng thắng')->exists() && ($order->status == 'failed')){
           $errorCharge =  charge::where('order_id','=', $order->id)->first();
           $errorCharge->delete();    
        }  
    }
}