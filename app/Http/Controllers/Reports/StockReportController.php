<?php

namespace App\Http\Controllers\Reports;
use App\Http\Controllers\Controller;

use App\Models\StockMutation;
use App\Models\Item;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockReportController extends Controller
{
    public function stock(Request $request)
    {
        $stock = Item::with('mutation')->get();
        // dd($stock);
        if ($request->tanggal==NULL) {
            # code...
            if ($request->item_id==NULL) {
                # code...
                $mutations = StockMutation::with('item')->orderBy('created_at', 'desc')->get();
            } else {
                # code...
                $mutations = StockMutation::with('item')->where('item_id', $request->item_id)->orderBy('created_at', 'desc')->get();
            }
        } else {
            # code...
            if ($request->item_id==NULL) {
                # code...
                switch ($request->jenis) {
                    case 'Harian':
                        # code...
                        $mutations = StockMutation::with('item')->whereDate('created_at', $request->tanggal)->orderBy('created_at', 'desc')->get();
                        break;
                    
                    case 'Bulanan':
                        # code...
                        $mutations = StockMutation::with('item')->whereMonth('created_at', $request->tanggal)->orderBy('created_at', 'desc')->get();
                        break;
                    
                    case 'Tahunan':
                        # code...
                        $mutations = StockMutation::with('item')->whereYear('created_at', $request->tanggal)->orderBy('created_at', 'desc')->get();
                        break;
                        
                    default:
                        # code...
                        break;
                }
            } else {
                # code...
                switch ($request->jenis) {
                    case 'Harian':
                        # code...
                        $mutations = StockMutation::with('item')->where('item_id', $request->item_id)->whereDate('created_at', $request->tanggal)->orderBy('created_at', 'desc')->get();
                        break;
                    
                    case 'Bulanan':
                        # code...
                        $mutations = StockMutation::with('item')->where('item_id', $request->item_id)->whereMonth('created_at', $request->tanggal)->orderBy('created_at', 'desc')->get();
                        break;
                    
                    case 'Tahunan':
                        # code...
                        $mutations = StockMutation::with('item')->where('item_id', $request->item_id)->whereYear('created_at', $request->tanggal)->orderBy('created_at', 'desc')->get();
                        break;
                        
                    default:
                        # code...
                        break;
                }
            }

        }
        $items = Item::all();
        
        $data_masuk = StockMutation::where('jenis_mutasi', 'penambahan')->get()->groupBy(function($d) {
            return Carbon::parse($d->created_at)->format('F');
        })->map(function ($row) {
            return $row->sum('stok_mutasi');
        });
        $data_keluar = StockMutation::where('jenis_mutasi', 'pengurangan')->get()->groupBy(function($d) {
            return Carbon::parse($d->created_at)->format('F');
        })->map(function ($row) {
            return $row->sum('stok_mutasi');
        });
        $chart_data_masuk = [];
        $chart_data_keluar = [];
        foreach ($data_masuk as $key => $value) {
            $chart_data_masuk[$key] = $value;
        }
        foreach ($data_keluar as $key => $value) {
            $chart_data_keluar[$key] = $value;
        }
        // dd($chart_data_keluar);
        $chart = new StockReportController;
        $chart->masuk_labels = (array_keys($chart_data_masuk));
        $chart->keluar_labels = (array_keys($chart_data_keluar));
        $chart->masuk_datasets = (array_values($chart_data_masuk));
        $chart->keluar_datasets = (array_values($chart_data_keluar));
        // dd($chart);
        return view('toko.laporan.mutasi_index', compact('mutations', 'items', 'request', 'chart', 'stock'));
    }

    public function stock_print(Request $request)
    {
        if ($request->tanggal==NULL) {
            # code...
            $mutations = StockMutation::with('item')->orderBy('item_id')->get();
            // dd($mutations);
        } else {
            # code...
            if ($request->item_id==NULL) {
                # code...
                switch ($request->jenis) {
                    case 'Harian':
                        # code...
                        $mutations = StockMutation::with('item')->whereDate('created_at', $request->tanggal)->orderBy('item_id')->get();
                        break;
                    
                    case 'Bulanan':
                        # code...
                        $mutations = StockMutation::with('item')->whereMonth('created_at', $request->tanggal)->orderBy('item_id')->get();
                        break;
                    
                    case 'Tahunan':
                        # code...
                        $mutations = StockMutation::with('item')->whereYear('created_at', $request->tanggal)->orderBy('item_id')->get();
                        break;
                        
                    default:
                        # code...
                        break;
                }
            } else {
                # code...
                switch ($request->jenis) {
                    case 'Harian':
                        # code...
                        $mutations = StockMutation::with('item')->where('item_id', $request->item_id)->whereDate('created_at', $request->tanggal)->orderBy('item_id')->get();
                        break;
                    
                    case 'Bulanan':
                        # code...
                        $mutations = StockMutation::with('item')->where('item_id', $request->item_id)->whereMonth('created_at', $request->tanggal)->orderBy('item_id')->get();
                        break;
                    
                    case 'Tahunan':
                        # code...
                        $mutations = StockMutation::with('item')->where('item_id', $request->item_id)->whereYear('created_at', $request->tanggal)->orderBy('item_id')->get();
                        break;
                        
                    default:
                        # code...
                        break;
                }
            }

        }
        $items = Item::all();

        return view('toko.laporan.mutasi_print', compact('mutations', 'items', 'request'));
    }

    public function stock_item_print(Request $request)
    {
        # code...
        // dd($request);
        switch ($request->jenis2) {
            case 'Harian':
                # code...
                $items = Item::with(['mutation' => function($query) use ($request) {
                            $query->whereDate('created_at', $request->tanggal2);
                        }])->whereHas('mutation', function($q) use ($request) {
                            $q->whereDate('created_at', $request->tanggal2);
                        })->get();
                break;
            
            case 'Bulanan':
                # code...
                $items = Item::with(['mutation' => function($query) use ($request) {
                    $query->whereMonth('created_at', $request->tanggal2);
                }])->whereHas('mutation', function($q) use ($request) {
                    $q->whereMonth('created_at', $request->tanggal2);
                })->get();
                break;
            
            case 'Tahunan':
                # code...
                $items = Item::with(['mutation' => function($query) use ($request) {
                    $query->whereYear('created_at', $request->tanggal2);
                }])->whereHas('mutation', function($q) use ($request){
                    $q->whereYear('created_at', $request->tanggal2);
                })->get();
                break;
                
            default:
                # code...
                $items = Item::with('mutation')->get();
                break;
        }
        return view('toko.laporan.mutasi_item_print', compact('items', 'request'));
    }
}
