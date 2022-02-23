<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;
use App\Models\Stock;
use App\Models\Bill;
use App\Models\Calculation;
use App\Models\Billreciepts;
use App\Models\Billreciepts_copy;
use Illuminate\Support\Facades\DB;
use App\Exports\BillingExport;
use App\Exports\SearchBillingExport;
use Maatwebsite\Excel\Facades\Excel;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;
use Session;
use PDF;



class BillController extends Controller
{
   
    function add_bill(Request $req){
        if($req->session()->has('user')){
            $oil_name = $req->oil_name;

            $result = Station::join('stocks', 'stocks.id', '=', 'stations.id')
            ->where('stations.oil_name', $oil_name)
            ->get();
            
            $bill = new Bill;
            if($req->oil_value == "Quantity"){
                foreach ($result as $res){
                    $bill->oil_name = $res['oil_name'];
                    $bill->price = $res['price'];
                }
                $bill->qty = $req->oil_quantity;
                $bill->total = $bill->qty * $bill->price;
                $bill->save();

                $reduces = DB::table('stocks')
                ->where('stocks.oil_name', 'LIKE', "%$oil_name%")
                ->get();

                foreach ($reduces as $reduce){
                    $reduce->cur_ltr = $reduce->cur_ltr - $req->oil_quantity;
                    DB::table('stocks')
                    ->where('oil_name', $reduce->oil_name)
                    ->update(['cur_ltr'=> $reduce->cur_ltr]);
                }
            }
            if($req->oil_value == "Taka"){
                foreach ($result as $res){
                    $bill->oil_name = $res['oil_name'];
                    $bill->price = $res['price'];
                }
                $bill->qty = round($req->oil_quantity / $bill->price, 2);
                $bill->total = $req->oil_quantity;
                $bill->save();
                
                $reduces = DB::table('stocks')
                ->where('stocks.oil_name', 'LIKE', "%$oil_name%")
                ->get();

                foreach ($reduces as $reduce){
                    $reduce->cur_ltr = $reduce->cur_ltr - $bill->qty;
                    DB::table('stocks')
                    ->where('oil_name', $reduce->oil_name)
                    ->update(['cur_ltr'=> $reduce->cur_ltr]);
                }
            }

            return redirect('/admin_dash');
        }
        else{
            return redirect('/login');
        }
    }

    function add_bill_user(Request $req){
        if($req->session()->has('user')){
            $oil_name = $req->oil_name;

            $result = Station::join('stocks', 'stocks.id', '=', 'stations.id')
            ->where('stations.oil_name', $oil_name)
            ->get();
            
            $bill = new Bill;
            if($req->oil_value == "Quantity"){
                foreach ($result as $res){
                    $bill->oil_name = $res['oil_name'];
                    $bill->price = $res['price'];
                }
                $bill->qty = $req->oil_quantity;
                $bill->total = $bill->qty * $bill->price;
                $bill->save();

                $reduces = DB::table('stocks')
                ->where('stocks.oil_name', 'LIKE', "%$oil_name%")
                ->get();

                foreach ($reduces as $reduce){
                    $reduce->cur_ltr = $reduce->cur_ltr - $req->oil_quantity;
                    DB::table('stocks')
                    ->where('oil_name', $reduce->oil_name)
                    ->update(['cur_ltr'=> $reduce->cur_ltr]);
                }
            }
            if($req->oil_value == "Taka"){
                foreach ($result as $res){
                    $bill->oil_name = $res['oil_name'];
                    $bill->price = $res['price'];
                }
                $bill->qty = round($req->oil_quantity / $bill->price, 2);
                $bill->total = $req->oil_quantity;
                $bill->save();
                
                $reduces = DB::table('stocks')
                ->where('stocks.oil_name', 'LIKE', "%$oil_name%")
                ->get();

                foreach ($reduces as $reduce){
                    $reduce->cur_ltr = $reduce->cur_ltr - $bill->qty;
                    DB::table('stocks')
                    ->where('oil_name', $reduce->oil_name)
                    ->update(['cur_ltr'=> $reduce->cur_ltr]);
                }
            }

            return redirect('/user_dash');
        }
        else{
            return redirect('/login');
        }
    }

    // function show_bill(){
    //     if(session()->has('user')){
    //         $bills = Bill::all();
    //         return view('admin_dash', ['bills'=>$bills]);
    //     }
    //     else{
    //         return redirect('/login');
    //     }
    // }

    function delete($id){
        if(session()->has('user')){
            $pid = \Crypt::decrypt($id);
            $data = Bill::find($pid);

            $oil_name = $data->oil_name;
            
            $reduces = DB::table('stocks')
                ->where('stocks.oil_name', 'LIKE', "%$oil_name%")
                ->get();

            foreach ($reduces as $reduce){
                $reduce->cur_ltr = $reduce->cur_ltr + $data->qty;
                    
                DB::table('stocks')
                ->where('oil_name', $reduce->oil_name)
                ->update(['cur_ltr'=> $reduce->cur_ltr]);
            }
            $data->delete();
            return redirect('admin_dash');
        }
        else{
            return redirect('/login');
        }

    }
    function print_bill(Request $req){
        if(session()->has('user')){ 
            $d_commision = 1.95;
            $p_commision = 3.90;
            $o_commision = 4;
            $depriciate = 0.04;
            $d_sub_total_1 = 0;
            $d_sub_total_2 = 0;
            $p_sub_total = 0;
            $o_sub_total = 0;
            $l_sub_total = 0;   
            $bills = DB::table('bills')
                    ->get();
            $invoice_count = rand(1, 9999999);
            $newbill = new Billreciepts;
            $newbill->invoice_no = 'SAP-'.$invoice_count;
            $newbill->user = Session::get('user')['name'];
            $invoice = 'SAP-'.$invoice_count;  
            
            foreach ($bills as $bill){
                if($bill->oil_name == 'Diesel-1'){
                    $newbill->d_name_1 = $bill->oil_name;
                    $newbill->d_quantity_1 = $bill->qty;
                    $newbill->d_unit_price_1 = $bill->price;
                    $total_commision = $d_commision * $bill->qty;
                    $newbill->d_commision_1 = $total_commision;
                    $d_sub_total_1 = $bill->total - $total_commision;
                    $newbill->d_subtotal_1 = $d_sub_total_1;
                    $newbill->d_depriciate_1 = $bill->qty * $depriciate;
                }
                if($bill->oil_name == 'Diesel-2'){
                    $newbill->d_name_2 = $bill->oil_name;
                    $newbill->d_quantity_2 = $bill->qty;
                    $newbill->d_unit_price_2 = $bill->price;
                    $total_commision = $d_commision * $bill->qty;
                    $newbill->d_commision_2 = $total_commision;
                    $d_sub_total_2 = $bill->total - $total_commision;
                    $newbill->d_subtotal_2 = $d_sub_total_2;
                    $newbill->d_depriciate_2 = $bill->qty * $depriciate;
                }
                if($bill->oil_name == 'Petrol'){
                    $newbill->p_name = $bill->oil_name;
                    $newbill->p_quantity = $bill->qty;
                    $newbill->p_unit_price = $bill->price;
                    $total_commision = $p_commision * $bill->qty;
                    $newbill->p_commision = $total_commision;
                    $p_sub_total = $bill->total - $total_commision;
                    $newbill->p_subtotal = $p_sub_total;
                    $newbill->p_depriciate = $bill->qty * $depriciate; 
                }
                if($bill->oil_name == 'Octane'){
                    $newbill->o_name = $bill->oil_name;
                    $newbill->o_quantity = $bill->qty;
                    $newbill->o_unit_price = $bill->price;
                    $total_commision = $o_commision * $bill->qty;
                    $newbill->o_commision = $total_commision;
                    $o_sub_total = $bill->total - $total_commision;
                    $newbill->o_subtotal = $o_sub_total;
                    $newbill->o_depriciate = $bill->qty * $depriciate;
                }
                if($bill->oil_name == 'Lub'){
                    $newbill->l_name = $bill->oil_name;
                    $newbill->l_quantity = $bill->qty;
                    $newbill->l_unit_price = $bill->price;
                    $l_sub_total = $bill->qty * $bill->price;
                    $newbill->l_subtotal = $l_sub_total;
                }
                $grand = $d_sub_total_1 + $d_sub_total_2 + $p_sub_total + $o_sub_total + $l_sub_total;
                $newbill->grandtotal = $d_sub_total_1 + $d_sub_total_2 + $p_sub_total + $o_sub_total + $l_sub_total;
                $newbill->vehicle = $req->vehicale_no ?: 'N/A';
                $newbill->save();
            }
            // return PDF::loadFile(public_path().'/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');

            if($req->has('print')){
                $bills = DB::table('bills')
                    ->get();
                $grand = 0;
                foreach ($bills as $bill){
                    $grand = $grand + $bill->total;
                }
                
                $cal = new Calculation;
                $cal->v_no = $req->vehicale_no ?: 'N/A';
                $cal->r_amount = $req->r_amount;
                $cal->p_amount = $grand;
                $cal->ret_amount = round($req->r_amount - $grand, 3);
                $cal->save();
            }
            $bills = Bill::all();

            foreach ($bills as $bill){
                $time = $bill->created_at->format('d-m-Y h:i:s a');
                break;
            }

            $calculation = DB::table('calculations')->where('id', 1)->first();;
            
            $path = base_path('saptak.jpg');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);

            $customPaper = array(0,0,250.80, 420.00);
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('pdf', ['bills' => $bills, 'invoice' => $invoice, 'pic' => $pic, 'calculation' => $calculation, 'time' => $time])
            ->setPaper($customPaper, 'portrait');;

            Bill::truncate();
            Calculation::truncate();

            return $pdf->stream('invoice.pdf');
        }
        else{
            return redirect('/login');
        }

         
    }

    function billing_reports(){
        if(session()->has('user')){ 
            Billreciepts_copy::truncate(); 
            $bills = DB::table('billreciepts')
            ->orderBy('created_at', 'DESC')
            ->paginate(9);
            return view('billing_reports', ['bills' => $bills]);    
        }
        else{
            return redirect('/login');
        }
    }

    function search(Request $req){
        if(session()->has('user')){
            $from = $req->from_date;
            $to = $req->to_date; 
            // $from = date('Y-m-d', strtotime($req->from_date));
            // $to = date('Y-m-d', strtotime($req->to_date));  
            // dd($from);
            // dd($from);

            $results = DB::table('billreciepts')->select()
                        ->whereDate('created_at', '>=', $from)
                        ->whereDate('created_at', '<=', $to)
                        ->orderBy('created_at', 'DESC')
                        ->get();
                        
            // dd($stocks);

            foreach ($results as $result){
                $bill = new Billreciepts_copy;
                $bill->id = $result->id;
                $bill->user = $result->user;
                $bill->invoice_no = $result->invoice_no;
                $bill->vehicle = $result->vehicle;
                $bill->d_name_1 = $result->d_name_1;
                $bill->d_quantity_1 = $result->d_quantity_1;
                $bill->d_unit_price_1 = $result->d_unit_price_1;
                $bill->d_commision_1 = $result->d_commision_1;
                $bill->d_subtotal_1 = $result->d_subtotal_1;
                $bill->d_depriciate_1 = $result->d_depriciate_1;

                $bill->d_name_2 = $result->d_name_2;
                $bill->d_quantity_2 = $result->d_quantity_2;
                $bill->d_unit_price_2 = $result->d_unit_price_2;
                $bill->d_commision_2 = $result->d_commision_2;
                $bill->d_subtotal_2 = $result->d_subtotal_2;
                $bill->d_depriciate_2 = $result->d_depriciate_2;

                $bill->p_name = $result->p_name;
                $bill->p_quantity = $result->p_quantity;
                $bill->p_unit_price= $result->p_unit_price;
                $bill->p_commision = $result->p_commision;
                $bill->p_subtotal = $result->p_subtotal;
                $bill->p_depriciate = $result->p_depriciate;

                $bill->o_name = $result->o_name;
                $bill->o_quantity = $result->o_quantity;
                $bill->o_unit_price= $result->o_unit_price;
                $bill->o_commision = $result->o_commision;
                $bill->o_subtotal = $result->o_subtotal;
                $bill->o_depriciate = $result->o_depriciate;

                $bill->l_name = $result->l_name;
                $bill->l_quantity = $result->l_quantity;
                $bill->l_unit_price= $result->l_unit_price;
                $bill->l_subtotal = $result->l_subtotal;

                $bill->grandtotal = $result->grandtotal;
                $bill->created_at = $result->created_at;
                $bill->save();
            }

            $bills = Billreciepts_copy::all();
            // $bills = DB::table('billreciepts_copies')->paginate(9);
            return view('bill_search', ['bills' => $bills]);

            
            // return redirect('/stock_reports');
            
        }
        else{
            return redirect('/login');
        }
    }

    function download_all(){
        return Excel::download(new BillingExport, 'Bills.xlsx');
    }

    function download_search(){
        return Excel::download(new SearchBillingExport, 'Search_Bills.xlsx');
    }

}
