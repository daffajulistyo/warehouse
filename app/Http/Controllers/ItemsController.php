<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Unit;
use App\Models\StockMutation;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = Item::orderBy('nama')->get();
        return view('stok/barang/barang_index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();
        return view('stok/barang/barang_create', compact('categories', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'category_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'harga_beli' => 'required|numeric',
        ]);


        $item = Item::create([
            'nama' => $request->nama,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'harga_beli' => $request->harga_beli,
            'stok' => 0,
        ]);

        StockMutation::create([
            'item_id' => $item->id,
            'stok_awal' => 0,
            'stok_mutasi' => 0,
            'stok_akhir' => 0,
            'jenis_mutasi' => 'penambahan',
            'keterangan' => 'Inisialisasi Barang Baru',
        ]);

        return redirect('/items')->with('message', 'Data Barang Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('data/stok/stok_show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        $units = Unit::all();
        return view('stok/barang/barang_edit', compact('categories', 'units', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {


        Item::where('id', $item->id)
            ->update([
                'nama' => $request->nama,
                'category_id' => $request->category_id,
                'unit_id' => $request->unit_id,
                'harga_beli' => $request->harga_beli,
                'stok' => $item->stok,
            ]);
        return redirect('/items')->with('message', 'Data Barang Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        Item::destroy($item->id);
        return redirect('/items')->with('message', 'Data Barang Berhasil Dihapus');
    }
}
