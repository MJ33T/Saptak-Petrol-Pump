<?php

namespace App\Http\Controllers;
use App\Models\Station;
use App\Models\Bill;
use Session;

use Illuminate\Http\Request;

class StationController extends Controller
{
    function show_oil_price(){
        if(session()->has('user')){
            $oils = Station::all();
            return view('oil_price', ['oils'=>$oils]);
        }
        else{
            return redirect('/login');
        }
    }

    function update_oil($id){
        if(session()->has('user')){
            $oid = \Crypt::decrypt($id);
            $oil = Station::find($oid);
            return view('update_oil', ['oil'=>$oil]);
        }
        else{
            return redirect('/login');
        }
    }

    function oil_price_change(Request $req){
        if(session()->has('user')){
            $oil = Station::find($req->id);
            $oil->price = $req->update_oil;
            $oil->save();
            return redirect('oil_price');    
        }
        else{
            return redirect('/login');
        }
    }

    function show_admin(){
        if(session()->has('user')){
            $oils = Station::all();
            $bills = Bill::all();
            return view('admin_dash',compact(['oils','bills']));
    
        }
        else{
            return redirect('/login');
        }

    }

    function show_user(){
        if(session()->has('user')){
            $oils = Station::all();
            $bills = Bill::all();
            return view('user_dash',compact(['oils','bills']));
    
        }
        else{
            return redirect('/login');
        }
    }
}