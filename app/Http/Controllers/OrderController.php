<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Customer;
use \App\order;
use \App\charge;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $orders = order::where('user_id', auth()->id())
               ->orderBy('created_at', 'desc')
               ->get();
        return view("order.index", compact("orders"));
    }
    //
    public function create($customerId = null){
        $customers = Customer::where('user_id', auth()->id())
               ->orderBy('id', 'desc')
               ->get();
        if ( $customerId != null) {        
            return view("order.create", compact("customerId","customers"));
        }
        else{
            return view("order.create", compact("customers"));
        }      
    }
    public function details($id){
        $order = order::findOrFail($id);
        return view("order.details", compact("order"));
    }

    public function store(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order = new order();
        $order->user_id  = auth()->id();
        $order->customer_id = request('customer_id');
        $order->type = request('type');
        $order->ngay = request('ngay');
        $order->created_at = date('Y-m-d H:i:s');
        $order->code= request('code');
        $order->sotien = request('sotien');
        $order->status = "waiting";
        $order->save();

        $feeCharge = new charge();
        $feeCharge->user_id = auth()->id();
        $feeCharge->customer_id = request('customer_id');
        $feeCharge->chargeMoney = 0 - request('sotien');
        $feeCharge->created_at = date('Y-m-d H:i:s');
        $feeCharge->order_id = $order->id;
        $feeCharge->note = "Đặt lệnh";
        $feeCharge->save(); 

        if (request('tratruoc') != 0) {
            $charge = new charge();
            $charge->user_id = auth()->id();
            $charge->customer_id = request('customer_id');
            $charge->chargeMoney = request('tratruoc');
            $charge->order_id = $order->id;
            $charge->created_at = date('Y-m-d H:i:s');
            $charge->note= "Thanh toán";
            $charge->save(); 
        }
        
        return redirect('/order/index');
    }
}
