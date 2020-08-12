<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Payment;
use App\User;
class PaymentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $payments = Payment::all();
        $users = User::where('status','1')->get();
        $customers = Customer::where('status','1')->get();
        return view("payment.index", compact('payments','customers','users'));
    }

    public function create($customerId = null){
        $customers = Customer::all();
        if ( $customerId != null) {        
            return view("payment.create", compact("customerId","customers"));
        }
        else{
            return view("payment.create", compact("customers"));
        }
    }

    public function search(Request $request) {
        $payments = Payment::query()->userId($request)->customerId($request)->date($request);
        $users = User::where('status','1')->get();
        $customers = Customer::where('status','1')->get();
        return view("payment.index", compact("payments","customers", "users"));
    }

    public function store(){
        $payment = new Payment();
        $payment->user_id  = auth()->id();
        $payment->customer_id = request('customer_id');
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $payment->date = date('Y-m-d H:i:s');
        $payment->amount = str_replace(',','',request('amount'));
        $payment->note = request('note');
        $payment->save();
        return redirect("/payment/index");
    }
}
