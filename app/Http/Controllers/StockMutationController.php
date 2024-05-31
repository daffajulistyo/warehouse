<?php

namespace App\Http\Controllers;

use App\Models\StockMutation;
use App\Models\Item;
use Illuminate\Http\Request;

class StockMutationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mutations = StockMutation::all();
        return view('stok.mutasi.mutasi_index', compact('mutations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all();
        return view('stok.mutasi.mutasi_create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if ($request->jenis_mutasi == 'penambahan') {
            # code...
            $stok_akhir = $request->stok_awal + $request->stok_mutasi;
            StockMutation::create([
                'item_id' => $request->item_id,
                'stok_awal' => $request->stok_awal,
                'stok_mutasi' => $request->stok_mutasi,
                'stok_akhir' => $stok_akhir,
                'jenis_mutasi' => $request->jenis_mutasi,
                'keterangan' => $request->keterangan,
            ]);
            Item::where('id', $request->item_id)->update([
                'stok' => $stok_akhir,
            ]);
        } elseif ($request->jenis_mutasi == 'pengurangan') {
            # code...
            $stok_akhir = $request->stok_awal - $request->stok_mutasi;
            StockMutation::create([
                'item_id' => $request->item_id,
                'stok_awal' => $request->stok_awal,
                'stok_mutasi' => $request->stok_mutasi,
                'stok_akhir' => $stok_akhir,
                'jenis_mutasi' => $request->jenis_mutasi,
                'keterangan' => $request->keterangan,
            ]);
            Item::where('id', $request->item_id)->update([
                'stok' => $stok_akhir,
            ]);
        }

        return redirect('/items/mutations')->with('message', 'Stok Berhasil Dikoreksi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockMutation  $stockMutation
     * @return \Illuminate\Http\Response
     */
    public function show(StockMutation $stockMutation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockMutation  $stockMutation
     * @return \Illuminate\Http\Response
     */
    public function edit(StockMutation $stockMutation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StockMutation  $stockMutation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockMutation $stockMutation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockMutation  $stockMutation
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockMutation $stockMutation)
    {
        //
    }
}
