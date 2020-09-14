<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Customer;
use \App\Expense;
use \App\User;
use Auth;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        $expenses = Expense::orderBy('created_at')->get();
        $users = User::where('status','1')->get();
        return view("expense.index", compact('expenses','users'));
    }

    public function create(){
        return view("expense.create");
    }

    public function search(Request $request) {
        $expenses = Expense::query()->userId($request)->date($request)->get();
        $users = User::where('status','1')->get();
        return view("expense.index", compact("expenses", "users"));
    }

    public function store(){
        $expense = new Expense();
        $expense->user_id  = auth()->id();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $expense->date = date('Y-m-d');
        $expense->amount = str_replace(',','',request('amount'));
        $expense->content = request('content');
        $expense->save();
        return redirect("/expense/index");
    }

    public function destroy($id) {
        if (Auth::user()->hasAdminPermission()) {
            $expense = expense::findOrFail($id);
            if ($expense->user_id == Auth::user()->id) {
                $expense->delete();
            return redirect('/expense/index');
            } else {
                error('404');
            }
        } else {
            error('404');
        } 
    }

    public function details($id){
        $expense = Expense::findOrFail($id);
        return view("expense.details", compact("expense"));
    }
}
