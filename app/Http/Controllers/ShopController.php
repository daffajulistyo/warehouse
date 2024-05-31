<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Unit;

use Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);
        $categories = Category::all();
        $cart_count = Cart::where('user_id', Auth::user()->id)->count();
        if (is_null($request->search)) {
            # code...
            $items = Item::where('stok', '!=', 'NULL')->get();
            return view ('shop.landing', compact('categories', 'items', 'cart_count'));
        } else {
            # code...
            $items = Item::where('nama', 'like', '%'.$request->search.'%')->where('stok', '!=', 'NULL')->get();
            return view ('shop.landing', compact('categories', 'items', 'cart_count', 'request'));
        }
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
        $cart = Cart::where('user_id', Auth::user()->id)->where('item_id', $request->item_id);
        // dd($cart->first()->jumlah);
        if ($cart->count() == 1) {
            # code...
            $cart->update([
                'jumlah' => $request->jumlah + $cart->first()->jumlah
            ]);
        } else {
            # code...
            Cart::create([
                'user_id' => Auth::user()->id,
                'item_id' => $request->item_id,
                'jumlah' => $request->jumlah
            ]);
        }
        return redirect('/cart')->with('message', 'Barang Sudah Dimasukkan Keranjang!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $categories = Category::all();
        $cart_count = Cart::where('user_id', Auth::user()->id)->count();
        $item = Item::find($id);
        // dd($items);
        return view ('shop.item', compact('item', 'cart_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
