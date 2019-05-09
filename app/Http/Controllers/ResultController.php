<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ketqualo;
use App\ketquade;
use Goutte\Client;
use App\order;
use App\charge;

class ResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(){            
        $deresult = ketquade::orderBy('ngay', 'desc')->first();
        $loresult = ketqualo::orderBy('id', 'desc')->first();
        $los = null;
        if ($loresult != null) {
            $los = str_split($loresult->ketqua, 2);
        }  
        return view('result.index' , compact("deresult","los"));
    }

    public function filter(){
        $loresult = ketqualo::where('ngay', '=', request('ngay'))->first();
        $los = null;
        if ($loresult != null) {
            $los = str_split($loresult->ketqua, 2);
        } 
        $deresult = ketquade::where('ngay', '=', request('ngay'))->first();
        $ngay = request('ngay');
        return view('result.index' , compact("deresult","los","ngay"));
    }

    public function inputScore(){
        return view('result.input');
    }

    public function store(){

        $ngay = request('ngay');
        $kqlo = preg_replace('/\D/', '', request('lo'));
        $kqde = preg_replace('/\D/', '', request('de'));
        if(strlen($kqlo) != 54){
            $message= "Dãy số lô không chính xác";
            return view('result.input', compact('message'));
        }
        if (ketquade::where('ngay','=', $ngay)->exists()){
            $de = ketquade::where('ngay','=', $ngay)->first();
        } else {
            $de = new ketquade();
        }
        $de->ngay = $ngay;
        $de->ketqua = $kqde;
        $de->save();
        if (ketqualo::where('ngay','=', $ngay)->exists()){
            $lo = ketqualo::where('ngay','=', $ngay)->first();
        } else {
            $lo = new ketqualo();
        }
        $lo->ngay = $ngay;
        $lo->ketqua = $kqlo;
        $lo->save();
        $this->updateOrdersResult($ngay);
        return $this->index();
    }

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
        return $this->index() ;
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
        if($order->status == 'success'){
            if (charge::where('order_id','=', $order->id)->where('note', '=', 'Thưởng thắng')->exists() == false) {
                $rewardcharge = new charge();
            } else {
                $rewardcharge = charge::where('order_id','=', $order->id)->where('note', '=', 'Thưởng thắng')->first();
            }          
            $rewardcharge->user_id  = auth()->id();
            $rewardcharge->customer_id = $order->customer_id;
            $rewardcharge->order_id = $order->id;
            $rewardcharge->created_at = date('Y-m-d H:i:s');
            $rewardcharge->chargeMoney = $order->getRewardMoney() ;
            $rewardcharge->note = 'Thưởng thắng';
            $rewardcharge->save();
        }    
        if (charge::where('order_id','=', $order->id)->where('note', '=', 'Thưởng thắng')->exists() && ($order->status == 'failed')){
           $errorCharge =  charge::where('order_id','=', $order->id)->first();
           $errorCharge->delete();    
        }  
    }
}
