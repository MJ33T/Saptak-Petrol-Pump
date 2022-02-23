<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Sreports;
use App\Models\Sreports_copy;
use App\DataTables\SreportsDataTable;
use Illuminate\Support\Facades\DB;
use App\Imports\StockImport;
use App\Exports\StocksExport;
use App\Exports\SearchStocksExport;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class StockController extends Controller
{
    function show_stock(){
        if(session()->has('user')){
            $oils = Stock::all();
            return view('stock', ['oils'=>$oils]);
        }
        else{
            return redirect('/login');
        }
    }

    function Update_stock($id){
        if(session()->has('user')){
            $sid = \Crypt::decrypt($id);
            $stock = Stock::find($sid);
            return view('update_stock', ['stock'=>$stock]);
        }
        else{
            return redirect('/login');
        }
    }

    function add_stock(Request $req){
        if(session()->has('user')){
            $stock = Stock::find($req->id);
            $stock->new_ltr = $req->new_stock;
            $stock->cur_ltr = $stock->cur_ltr + $stock->new_ltr;
            $stock->save();

            $stockhis = new Sreports;
            $stockhis->oil_name = $stock->oil_name;
            $stockhis->qty = $stock->new_ltr;
            $stockhis->save();
            return redirect('stock');  
        }
        else{
            return redirect('/login');
        }
    }

    function stock_reports(){
        if(session()->has('user')){
            Sreports_copy::truncate();    
            $stocks = DB::table('sreports')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
            return view('stock_reports', ['stocks' => $stocks]);    
        }
        else{
            return redirect('/login');
        }
        
    }

    // function detail_stock(SreportsDataTable $dataTable){
    //     return $dataTable->render('stock_reports');
    // }

    function search(Request $req){
        if($req->session()->has('user')){
            $from = $req->from_date;
            $to = $req->to_date; 
            // $from = date('Y-m-d', strtotime($req->from_date));
            // $to = date('Y-m-d', strtotime($req->to_date));  
            // dd($from);
            // dd($from);

            $results = DB::table('sreports')->select()
                        ->whereDate('created_at', '>=', $from)
                        ->whereDate('created_at', '<=', $to)
                        ->orderBy('created_at', 'DESC')
                        ->get();
                        
            // dd($stocks);

            foreach ($results as $result){
                $stock = new Sreports_copy;
                $stock->id = $result->id;
                $stock->oil_name = $result->oil_name;
                $stock->qty = $result->qty;
                $stock->created_at = $result->created_at;
                $stock->save();
            }

            $stocks = Sreports_copy::all();
            return view('stock_search', ['stocks' => $stocks]);

            
            // return redirect('/stock_reports');
            
        }
        else{
            return redirect('/login');
        }
    }

    function download_all(){
        return Excel::download(new StocksExport, 'Stocks.xlsx');
    }

    function download_search(){
        return Excel::download(new SearchStocksExport, 'Search_Stocks.xlsx');
    }
}
