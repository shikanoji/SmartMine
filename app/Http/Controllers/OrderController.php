<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Customer;
use \App\Order;
use \App\Payment;
use \App\User;
use Auth;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $orders = order::orderBy('created_at')->get();
        $users = User::where('status','1')->get();
        $customers = Customer::where('status','1')->get();
        return view("order.index", compact("orders","customers","users"));
    }
    //
    public function create($customerId = null){
        $customers = Customer::all();
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

    public function search(Request $request) {
        $orders = Order::query()->userId($request)->customerId($request)->date($request)->productId($request)->get();
        $users = User::where('status','1')->get();
        $customers = Customer::where('status','1')->get();
        return view("order.index", compact("orders","customers","users"));
    }

    public function destroy($id) {
        if (Auth::user()->hasSalerPermission()) {
            $order = Order::findOrFail($id);
            if ($order->user_id == Auth::user()->id) {
                $order->delete();
            return redirect('/order/index');
            } else {
                error('404');
            }
        } else {
            error('404');
        } 
    }

    public function store(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order = new Order();
        $order->user_id  = auth()->id();
        $order->customer_id = request('customer_id');
        $order->product_id = request('product_id');
        $order->date = date('Y-m-d');
        $order->unit = request('unit');
        $order->amount = str_replace(',','',request('amount'));
        $order->charge = str_replace(',','',request('charge'));
        $order->save();

        $payment = new Payment();
        $payment->user_id = auth()->id();
        $payment->customer_id = request('customer_id');
        $payment->amount = str_replace(',','',request('payment_amount'));
        $payment->date = date('Y-m-d');
        $payment->note = "Thanh toán lúc giao dịch";
        $payment->save();
        
        return redirect('/order/index');
    }

}
