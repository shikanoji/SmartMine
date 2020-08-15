<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Customer;
use App\Payment;

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
        $orderCount = Order::where('date', date('Y-m-d'))->get()->count();
        $orderTotalValue = Order::where('date', date('Y-m-d'))->sum('charge');
        $customerCount = Order::where('date', date('Y-m-d'))->distinct('customer_id')->count();
        $dailyRevenue = Payment::where('date', date('Y-m-d'))->sum('amount');
        $revenuesByDate = [];
        $valuesByDate = [];
        for($i = 6; $i>=0; $i--) {
             $day = date( 'Y-m-d', strtotime( date('Y-m-d') . ' -'.$i.' day' ) );
             $revenue = Payment::where('date', $day)->sum('amount');
             $value =  Order::where('date', $day)->sum('charge');
             array_push($revenuesByDate, $revenue);
             array_push($valuesByDate, $value);
        }
        array_push($revenuesByDate, $dailyRevenue);
        array_push($valuesByDate, $orderTotalValue);
         
        $data = [
            'orderCount' => $orderCount,
            'orderTotalValue' => $orderTotalValue,
            'customerCount' => $customerCount,
            'dailyRevenue' => $dailyRevenue,
            'revenuesByDate' => $revenuesByDate,
            'valuesByDate' => $valuesByDate
         ];
        return view('home', compact('data'));
    }
}
