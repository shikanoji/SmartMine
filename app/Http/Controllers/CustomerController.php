<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
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
        $customers = Customer::where('user_id', auth()->id())
               ->orderBy('customerName', 'desc')
               ->get();
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
        if (Customer::where('sdt',request('sdt'))->exists() ){
            $warning = "Số điện thoại đã tồn tại";
            return view("customer.create", compact("warning") );  
        } else {         
            $customer = new Customer();
            $customer->customerName = request('ten');
            $customer->sdt = request('sdt');
            $customer->user_id = auth()->id();
            $customer->rateD = request('rateD');
            $customer->rateL = request('rateL');
            $customer->rateBC = request('rateBC');
            $customer->rateLx2= request('rateLx2');
            $customer->rateLx3 = request('rateLx3');
            $customer->rateLx4 = request('rateLx4');
            $customer->save();
            return redirect('/khachhang/list');       
        }
               
    }

    public function getAccounts(){
        $customers = Customer::where('user_id', auth()->id())
               ->orderBy('customerName', 'desc')
               ->get();
        return view("customer.accounts", compact("customers"));
    }

    public function destroy($id){
        Customer::findOrFail($id)->delete();
        return redirect('/khachhang/list');
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
        $customer->customerName = request('ten');
        $customer->sdt = request('sdt');
        $customer->rateD = request('rateD');
        $customer->rateL = request('rateL');
        $customer->rateBC = request('rateBC');
        $customer->rateLx2= request('rateLx2');
        $customer->rateLx3 = request('rateLx3');
        $customer->rateLx4 = request('rateLx4');
        $customer->save();
        return \Redirect::route('khachhang.details', [$id]);
    }
}