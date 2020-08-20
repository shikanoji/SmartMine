<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Payment;
use App\User;
use Auth;
class PaymentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $payments = Payment::orderBy('created_at')->get();
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
        $payments = Payment::query()->userId($request)->customerId($request)->date($request)->get();
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

    public function destroy($id) {
        if (Auth::user()->hasSalerPermission()) {
            $payment = Payment::findOrFail($id);
            if ($payment->user_id == Auth::user()->id) {
                $payment->delete();
            return redirect('/payment/index');
            } else {
                error('404');
            }
        } else {
            error('404');
        } 
    }

    public function details($id){
        $payment = Payment::findOrFail($id);
        return view("payment.details", compact("payment"));
    }
}
