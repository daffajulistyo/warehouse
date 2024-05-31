<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\StockMutation;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = Item::all()->count();
        $item_mutations = StockMutation::latest('created_at')->simplePaginate(5);
        $purchases = Purchase::all()->count();
        $sales = Sale::all()->count();
        $latest_sale = Sale::with('items')->latest('created_at')->simplePaginate(5);
        $customers = User::where('role', 'customer')->count();

        // dd($item_mutations);
        return view('dashboard', compact('items', 'item_mutations', 'purchases', 'sales', 'latest_sale', 'customers'));
    }
}