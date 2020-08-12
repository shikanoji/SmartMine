<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $products = Product::all();
        return view("product.index", compact("products"));
    }

    public function create()
    {
        if (Auth::user()->hasRole('ROLE_ADMIN')) {
            $warning = "none";
            return view("product.create", compact("warning"));
        }
    }

    public function store()
    {
        if (Auth::user()->hasRole('ROLE_ADMIN')) {
            $warning = "none";
            if (Product::where('name',request('name'))->exists() ){
                $warning = "Tên sản phẩm trùng";
                return view("product.create", compact("warning") );  
            } else {         
                $product = new Product();
                $product->name = request('name');
                $product->status = "1";
                $product->save();
                return redirect('/product/index');       
            }
        }
               
    }
    public function lock($id) {
        if (Auth::user()->hasRole('ROLE_ADMIN')) {
            $product = Product::findOrFail($id);
            if ($product->status == "1") {
                $product->status = "0";
            } else {
                $product->status = "1";
            }     
            $product->save();
            return redirect('/product/index');
        } else {
            error('404');
        }
    }

    public function destroy($id){
        if (Auth::user()->hasRole('ROLE_ADMIN')) {
            Product::findOrFail($id)->delete();
            return redirect('/product/index');
        }
    }

    public function details($id){
        $product = Product::findOrFail($id);
        return view("product.details", compact("product"));
    }

    public function edit($id){
        if (Auth::user()->hasRole('ROLE_ADMIN')) {
            $product = Product::findOrFail($id);
            return view("product.edit", compact("product"));
        }
    }

    public function update($id){
        if (Auth::user()->hasRole('ROLE_ADMIN')) {
            $product = Product::findOrFail($id);
            $product->name = request('name');
            $product->save();
            return view('/product/index');
        }
    }
}
