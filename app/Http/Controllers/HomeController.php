<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use App\Customer;
use App\charge;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $customers = Customer::where('user_id', auth()->id())->get();
        $orders =   order::where('user_id', auth()->id())->get();
        $totalAccount  =  0;
        foreach($customers as $customer) {
            $totalAccount = $totalAccount + $customer->getAccount();
        }  
        return view('home', compact('customers','orders', 'totalAccount'));
    }
}
