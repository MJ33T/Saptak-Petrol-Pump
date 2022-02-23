<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\BillController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout', function () {
    Session::forget('user');
    return redirect('login');
});


Route::view('/admin_dash', 'admin_dash');

Route::view('/user_dash', 'user_dash');

Route::view('/login', "login");


Route::post('/login', [UserController::class, 'login']);

Route::view('/oil_price', 'oil_price');

Route::get('/oil_price', [StationController::class, 'show_oil_price']);

Route::view('/', 'update_oil');

Route::get('update_oil/{id}', [StationController::class, 'update_oil']);

Route::post('/update_oil', [StationController::class, 'oil_price_change']);

Route::get('/admin_dash', [StationController::class, 'show_admin']);

Route::get('/user_dash', [StationController::class, 'show_user']);

Route::view('/stock', 'stock');

Route::get('/stock', [StockController::class, 'show_stock']);

Route::get('update_stock/{id}', [StockController::class, 'Update_stock']);

Route::post('update_stock', [StockController::class, 'add_stock']);

Route::post('/admin_dash', [BillController::class, 'add_bill']);

Route::post('/user_dash', [BillController::class, 'add_bill_user']);

Route::get('delete_bill/{id}', [BillController::class, 'delete']);

Route::get('print_bill', [BillController::class, 'print_bill']);

Route::post('print_bill', [BillController::class, 'print_bill']);

Route::view('reports', 'reports');

Route::get('/stock_reports', [StockController::class, 'stock_reports']);

// Route::get('/stock_reports', [StockController::class, 'detail_stock']);

Route::get('/stock_reports/exports', [StockController::class, 'download_all']);

Route::get('/stock_search/exports', [StockController::class, 'download_search']);

Route::post('stock_search', [StockController::class, 'search']);

Route::get('/billing_reports', [BillController::class, 'billing_reports']);

Route::get('/billing_reports/exports', [BillController::class, 'download_all']);

Route::get('/billing_search/exports', [BillController::class, 'download_search']);

Route::post('/billing_search', [BillController::class, 'search']);
