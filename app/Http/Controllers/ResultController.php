<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ketqualo;
use App\ketquade;
use Goutte\Client;
use App\order;
use App\charge;
use App\ScoreHelper;

class ResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(){            
        $deresult = ketquade::orderBy('ngay', 'desc')->first();
        $loresult = ketqualo::orderBy('id', 'desc')->first();
        $los = null;
        if ($loresult != null) {
            $los = str_split($loresult->ketqua, 2);
        }  
        return view('result.index' , compact("deresult","los"));
    }

    public function filter(){
        $loresult = ketqualo::where('ngay', '=', request('ngay'))->first();
        $los = null;
        if ($loresult != null) {
            $los = str_split($loresult->ketqua, 2);
        } 
        $deresult = ketquade::where('ngay', '=', request('ngay'))->first();
        $ngay = request('ngay');
        return view('result.index' , compact("deresult","los","ngay"));
    }

    public function inputScore(){
        return view('result.input');
    }

    public function store(){

        $ngay = request('ngay');
        $kqlo = preg_replace('/\D/', '', request('lo'));
        $kqde = preg_replace('/\D/', '', request('de'));
        if(strlen($kqlo) != 54){
            $message= "Dãy số lô không chính xác";
            return view('result.input', compact('message'));
        }
        if (ketquade::where('ngay','=', $ngay)->exists()){
            $de = ketquade::where('ngay','=', $ngay)->first();
        } else {
            $de = new ketquade();
        }
        $de->ngay = $ngay;
        $de->ketqua = $kqde;
        $de->save();
        if (ketqualo::where('ngay','=', $ngay)->exists()){
            $lo = ketqualo::where('ngay','=', $ngay)->first();
        } else {
            $lo = new ketqualo();
        }
        $lo->ngay = $ngay;
        $lo->ketqua = $kqlo;
        $lo->save();
        $scoreHelper = new ScoreHelper();
        $scoreHelper->updateOrdersResult($ngay);
        return $this->filter($ngay);
    }

    public function getTodayScore(){
        $scoreHelper = new ScoreHelper();
        $scoreHelper->getTodayScore();
        return $this->index() ;
    }

}
