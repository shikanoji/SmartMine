<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Auth;
class CustomerController extends Controller
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
    
    public function index()
    {
        $customers = Customer::all();
        return view("customer.customerlist", compact("customers"));
    }

    public function create()
    {
        $warning = "none";
        return view("customer.create", compact("warning"));
    }

    public function store()
    {
        $warning = "none";
        if (Customer::where('phone',request('phone'))->exists() ){
            $warning = "Số điện thoại bị trùng";
            return view("customer.create", compact("warning") );  
        } else {         
            $customer = new Customer();
            $customer->name = request('name');
            $customer->phone = request('phone');
            $customer->address = request('address');
            $customer->status = "1";
            $customer->save();
            return redirect('/customer/list');       
        }
               
    }

    public function lock($id) {
        if (Auth::user()->hasSalerPermission()) {
            $customer = Customer::findOrFail($id);
            if ($customer->status == "1") {
                $customer->status = "0";
            } else {
                $customer->status = "1";
            }     
            $customer->save();
            return redirect('/customer/list');
        } else {
            error('404');
        }
    }

    public function getAccounts(){
        $customers = Customer::all();
        return view("customer.accounts", compact("customers"));
    }

    public function destroy($id){
        if (Auth::user()->hasAdminPermission()) {
            Customer::findOrFail($id)->delete();
            return redirect('/customer/list');
        }        
    }

    public function details($id){
        $customer = Customer::findOrFail($id);
        return view("customer.details", compact("customer"));
    }

    public function edit($id){
        $customer = Customer::findOrFail($id);
        return view("customer.edit", compact("customer"));
    }

    public function update($id){
        $customer = Customer::findOrFail($id);
        $customer->name = request('name');
        $customer->phone = request('phone');
        $customer->address = request('address');
        $customer->save();
        return redirect('/customer/list');
    }
}