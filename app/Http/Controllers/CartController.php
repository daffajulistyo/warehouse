<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Sale;
use App\Models\StockMutation;
use App\Models\Unit;
use Illuminate\Http\Request;

use Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        // $items = Item::all();
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $cart_count = Cart::where('user_id', Auth::user()->id)->count();
        return view ('shop.cart', compact('categories', 'carts', 'cart_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'item_id' => 'required',
            'jumlah' => 'required',
        ]);
        
        $kode_transaksi = 'SLS'.sprintf("%04s", Sale::all()->count());
        $sale = Sale::create([
            'kode_transaksi' => $kode_transaksi,
            'status' => 'Belum Dibayar',
            'user_id' => Auth::user()->id,
            'total_bayar' => $request->total_bayar,
            'keterangan' => 'Pembelian atas nama '.Auth::user()->name,
        ]);
        $items = $request->input('item_id', []);
        $jumlah = $request->input('jumlah', []);
        for ($iteration=0; $iteration < count($items); $iteration++) {
            $sale->items()->attach($items[$iteration], ['jumlah' => $jumlah[$iteration]]);
        }
        Cart::where('user_id', Auth::user()->id)->delete();

        $request->session()->flash('message', 'Silahkan Berikan Struk ke Kasir.');
        return response()->json(['response'=>'200']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        Cart::where('id', $cart->id)
            ->update([
                'jumlah' => $request->jumlah,
            ]);
        return response()->json(['response'=>'200']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        Cart::destroy($cart->id);
        return redirect('/cart')->with('message', 'Barang Dihapus');
    }
}
