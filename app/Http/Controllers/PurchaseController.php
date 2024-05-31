<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use App\Models\StockMutation;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::with('purchaseDetail.items')->orderBy("created_at", "desc")->get();
        return view('stok.pembelian.pembelian_index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transaction_code = 'PCS'.sprintf("%04s", Purchase::all()->count());
        $suppliers = Supplier::all();
        $items = Item::orderBy('nama')->get();
        return view('stok.pembelian.pembelian_create', compact('suppliers', 'items', 'transaction_code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = Purchase::all()->count();
        Purchase::create([
            'kode_pembelian' => $request->kode_pembelian,
            'supplier_id' => $request->supplier_id,
            'total_bayar' => $request->total_bayar,
            'keterangan' => $request->keterangan,
        ]);
            
        $purchase = Purchase::latest()->first();
        // dd($purchase->id);
        $pdetail = PurchaseDetail::create([
            'purchase_id' => $purchase->id,
        ]);
        $items = $request->input('item_id', []);
        $jumlah = $request->input('jumlah', []);
        for ($iteration=0; $iteration < count($items); $iteration++) {
            
            $pdetail->items()->attach($items[$iteration], ['jumlah' => $jumlah[$iteration]]);

            $item = Item::find($items[$iteration]);

            StockMutation::create([
                'item_id' => $items[$iteration],
                'stok_awal' => $item->stok,
                'stok_mutasi' => $jumlah[$iteration],
                'stok_akhir' => $item->stok + $jumlah[$iteration],
                'jenis_mutasi' => 'penambahan',
                'keterangan' => 'Pembelian dengan Kode : '.$purchase->kode_pembelian,
            ]);

            $item->stok += $jumlah[$iteration];
            $item->save();
        }
        
        return redirect('/items/purchases')->with('message', 'Data Pembelian Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $suppliers = Supplier::all();
        $items = Item::all();
        $detail = PurchaseDetail::with('items')->where('id', $purchase->id)->first();
        return view('stok.pembelian.pembelian_edit', compact('purchase', 'detail', 'items', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        Purchase::where('id', $purchase->id)->update([
            'supplier_id' => $request->supplier_id,
            'total_bayar' => $request->total_bayar,
            'keterangan' => $request->keterangan,
        ]);

        // $pdetail = PurchaseDetail::where('id', $purchase->id)->first();
        $pdetail = PurchaseDetail::with('items')->find($purchase->id);
        // dd($pdetail->items);
        // dd($pdetail->items[0]->pivot->jumlah);
        // dd($pdetail);
        $items = $request->input('item_id', []);
        $jumlah = $request->input('jumlah', []);
        // dd($request);
        for ($iteration=0; $iteration < count($items); $iteration++) {
            dd($pdetail->items[1]->exists());
           
            $item = Item::where('id', $items[$iteration])->first();
            // dd(($item->stok - $pdetail->items[$iteration]->pivot->jumlah) + $jumlah[$iteration]);
            // $detail_stok = $pdetail->items()->where('id', 3)->first();
            $detail_stok = ($item->stok - $pdetail->items[$iteration]->pivot->jumlah) + $jumlah[$iteration];
            // dd($items[$iteration]);
            $item->stok = $detail_stok;
            $item->save();
            // $pdetail->items()->sync([
            //     $items[$iteration] => ['jumlah' => $jumlah[$iteration]]
            // ]);
        }
        
        // foreach ($items as $item) {
        //     # code...
        //     $iteration = 0;
        //     $item_id_array[$items[$iteration]] = ['jumlah' => $jumlah[$iteration]];
        //     $iteration++;
        // }
        // $pdetail->items()->sync($items);
        
        return redirect('/items/purchases')->with('message', 'Data Pembelian Dengan Code : '.$purchase->kode_pembelian.' Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        Purchase::find($purchase->id)->items()->detach();
        Purchase::destroy($purchase->id);
        return redirect('/items/purchases')->with('message', 'Pembelian Berhasil Dihapus');
    }
}
