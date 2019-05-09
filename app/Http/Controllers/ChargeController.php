<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\charge;

class ChargeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function create($customerId = null){
        $customers = Customer::where('user_id', auth()->id())
               ->orderBy('id', 'desc')
               ->get();
        if ( $customerId != null) {        
            return view("charge.create", compact("customerId","customers"));
        }
        else{
            return view("charge.create", compact("customers"));
        }
    }

    public function store(){
        $charge = new charge();
        $charge->user_id  = auth()->id();
        $charge->customer_id = request('customer_id');
        $charge->order_id = null;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $charge->created_at = date('Y-m-d H:i:s');
        $charge->chargeMoney = request('chargeMoney');
        $charge->note = request('note');
        $charge->save();
        return redirect('/charge/create');
    }
}
