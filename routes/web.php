<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Reports\PurchaseReportController;
use App\Http\Controllers\Reports\SaleReportController;
use App\Http\Controllers\Reports\StockReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StockMutationController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;

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

//Index Route
Route::get('/', [LoginController::class, 'showLoginForm']);

//Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Stok Routes
//Pembelian Barang
Route::resource('/items/purchases', PurchaseController::class);
//Mutasi Stok
Route::resource('/items/mutations', StockMutationController::class)->only([
    'index', 'create', 'store'
]);
//Barang
Route::resource('/items/categories', CategoryController::class);
Route::resource('/items/units', UnitController::class);
Route::resource('/items', ItemsController::class);
Route::resource('suppliers', SupplierController::class);


//Penjualan
Route::resource('sales', SaleController::class);
Route::resource('customers', CustomerController::class)->parameters(['customers' => 'user']);

//Data Toko
Route::resource('employees', EmployeeController::class)->parameters(['employees' => 'user']);

Route::get('/reports/purchase', [PurchaseReportController::class, 'purchase']);
Route::post('/reports/purchase', [PurchaseReportController::class, 'purchase']);
Route::get('/reports/purchase/print', [PurchaseReportController::class, 'purchase_print']);
Route::post('/reports/purchase/print', [PurchaseReportController::class, 'purchase_print']);

Route::get('/reports/sale', [SaleReportController::class, 'sale']);
Route::post('/reports/sale', [SaleReportController::class, 'sale']);
Route::get('/reports/sale/print', [SaleReportController::class, 'sale_print']);
Route::post('/reports/sale/print', [SaleReportController::class, 'sale_print']);
Route::post('/reports/sale/item_print', [SaleReportController::class, 'sale_item_print']);

Route::get('/reports/stock', [StockReportController::class, 'stock']);
Route::post('/reports/stock', [StockReportController::class, 'stock']);
Route::get('/reports/stock/print', [StockReportController::class, 'stock_print']);
Route::post('/reports/stock/print', [StockReportController::class, 'stock_print']);
Route::post('/reports/stock/item_print', [StockReportController::class, 'stock_item_print']);
//Data Toko

//Customer routes
Route::resource('shop', ShopController::class);
Route::post('/shop/search', [ShopController::class, 'index']);
Route::post('/shop/filter', [ShopController::class, 'index']);
Route::resource('cart', CartController::class);
Route::resource('orders', OrderController::class);

//Auth Routes
Auth::routes();
