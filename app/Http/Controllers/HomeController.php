<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Customer;
use App\Payment;
use App\Expense;

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
        $orderTotalValue = Order::where('date', date('Y-m-d'))->get()->sum('charge');
        $customerCount = Order::where('date', date('Y-m-d'))->distinct('customer_id')->count();
        $dailyRevenue = Payment::where('date', date('Y-m-d'))->get()->sum('amount');
        $dailyExpense = Expense::where('date', date('Y-m-d'))->get()->sum('amount');
        $revenuesByDate = [];
        $valuesByDate = [];
        $expenseByDate = [];
        for($i = 6; $i>=0; $i--) {
             $day = date( 'Y-m-d', strtotime( date('Y-m-d') . ' -'.$i.' day' ) );
             $revenue = Payment::where('date', $day)->sum('amount')/1000000;
             $expense = Expense::where('date', $day)->sum('amount')/1000000;
             $value =  Order::where('date', $day)->sum('charge')/1000000;
             array_push($revenuesByDate, $revenue);
             array_push($valuesByDate, $value);
             array_push($expenseByDate, $expense);
        }
        array_push($revenuesByDate, $dailyRevenue/1000000);
        array_push($valuesByDate, $orderTotalValue/1000000);
        array_push($expenseByDate, $dailyExpense/1000000);
        $data = [
            'orderCount' => $orderCount,
            'orderTotalValue' => $orderTotalValue,
            'customerCount' => $customerCount,
            'dailyRevenue' => $dailyRevenue,
            'dailyExpense' => $dailyExpense,
            'revenuesByDate' => $revenuesByDate,
            'valuesByDate' => $valuesByDate,
            'expenseByDate' => $expenseByDate,
         ];
        return view('home', compact('data'));
    }
}
