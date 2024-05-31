<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Sale;
use App\Models\StockMutation;
use App\Models\User;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::with('user', 'items')->orderBy('created_at', 'desc')->get();
        // dd($sale);
        return view('penjualan.penjualan_index', compact('sales'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transaction_code = 'SLS'.sprintf("%04s", Sale::all()->count());
        $customers = User::where('role', 'customer')->get();
        $items = Item::where('stok', '!=', 'NULL')->get();
        return view('penjualan.penjualan_create', compact('customers', 'transaction_code', 'items'));
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
        $sale = Sale::create([
            'kode_transaksi' => $request->kode_transaksi,
            'status' => $request->status,
            'user_id' => $request->user_id,
            'total_bayar' => $request->total_bayar,
            'keterangan' => $request->keterangan,
        ]);
        $items = $request->input('item_id', []);
        $jumlah = $request->input('jumlah', []);

        if (in_array($request->status, array('Lunas','Bayar Di Tempat'))) {
            # code...
            for ($iteration=0; $iteration < count($items); $iteration++) {
            
                $sale->items()->attach($items[$iteration], ['jumlah' => $jumlah[$iteration]]);
    
                $item = Item::find($items[$iteration]);
    
                StockMutation::create([
                    'item_id' => $items[$iteration],
                    'stok_awal' => $item->stok,
                    'stok_mutasi' => $jumlah[$iteration],
                    'stok_akhir' => $item->stok - $jumlah[$iteration],
                    'jenis_mutasi' => 'pengurangan',
                    'keterangan' => 'Penjualan dengan Kode : '.$request->kode_transaksi,
                ]);
    
                $item->stok -= $jumlah[$iteration];
                $item->save();
            }
        } else {
            # code...
            for ($iteration=0; $iteration < count($items); $iteration++) {
                $sale->items()->attach($items[$iteration], ['jumlah' => $jumlah[$iteration]]);
            }
        }

        return redirect('/sales')->with('message', 'Penjualan Dengan Code : '.$request->kode_transaksi.' Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $sales = Sale::with('user', 'items')->find($sale->id);
        // dd($sales);
        $customers = User::where('role', 'customer')->get();
        $items = Item::all();
        return view('penjualan.penjualan_edit', compact('customers', 'sales', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        // dd($request);
        $this_sale = Sale::find($sale->id);
        $this_sale->items()->detach();
        $this_sale->update([
            'status' => $request->status,
            'total_bayar' => $request->total_bayar,
            'keterangan' => $request->keterangan,
        ]);
        $items = $request->input('item_id', []);
        $jumlah = $request->input('jumlah', []);

        if (in_array($request->status, array('Lunas','Bayar Di Tempat'))) {
            # code...
            for ($iteration=0; $iteration < count($items); $iteration++) {
            
                $this_sale->items()->attach($items[$iteration], ['jumlah' => $jumlah[$iteration]]);
    
                $item = Item::find($items[$iteration]);
    
                StockMutation::create([
                    'item_id' => $items[$iteration],
                    'stok_awal' => $item->stok,
                    'stok_mutasi' => $jumlah[$iteration],
                    'stok_akhir' => $item->stok - $jumlah[$iteration],
                    'jenis_mutasi' => 'pengurangan',
                    'keterangan' => 'Penjualan dengan Kode : '.$request->kode_transaksi,
                ]);
    
                $item->stok -= $jumlah[$iteration];
                $item->save();
            }
        } else {
            # code...
            for ($iteration=0; $iteration < count($items); $iteration++) {
                $this_sale->items()->attach($items[$iteration], ['jumlah' => $jumlah[$iteration]]);
            }
        }

        return redirect('/sales')->with('message', 'Penjualan Dengan Kode : '.$request->kode_transaksi.' Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        Sale::find($sale->id)->items()->detach();
        Sale::destroy($sale->id);
        return redirect('/sales')->with('message', 'Transaksi Berhasil Dihapus');
    }
}
