<?php

namespace App\Http\Controllers\Reports;
use App\Http\Controllers\Controller;

use App\Models\Item;
use App\Models\Sale;
use App\Models\StockMutation;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleReportController extends Controller
{
    public function sale(Request $request)
    {
        if ($request->tanggal==NULL) {
            # code...
            if ($request->user_id==NULL) {
                # code...
                $sales = Sale::with('user', 'items')->where('status', 'Lunas')->orderBy("created_at", "desc")->get();
            } else {
                # code...
                $sales = Sale::with('user', 'items')->where('user_id', $request->user_id)->where('status', 'Lunas')->orderBy("created_at", "desc")->get();
            }
        } else {
            # code...
            if ($request->user_id==NULL) {
                # code...
                switch ($request->jenis) {
                    case 'Harian':
                        # code...
                        $sales = Sale::with('user', 'items')->where('status', 'Lunas')->whereDate('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                    
                    case 'Bulanan':
                        # code...
                        $sales = Sale::with('user', 'items')->where('status', 'Lunas')->whereMonth('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                    
                    case 'Tahunan':
                        # code...
                        $sales = Sale::with('user', 'items')->where('status', 'Lunas')->whereYear('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
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
                        $sales = Sale::with('user', 'items')->where('status', 'Lunas')->where('user_id', $request->user_id)->whereDate('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                    
                    case 'Bulanan':
                        # code...
                        $sales = Sale::with('user', 'items')->where('status', 'Lunas')->where('user_id', $request->user_id)->whereMonth('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                    
                    case 'Tahunan':
                        # code...
                        $sales = Sale::with('user', 'items')->where('status', 'Lunas')->where('user_id', $request->user_id)->whereYear('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                        
                    default:
                        # code...
                        break;
                }
            }

        }
        $users = User::where('role', 'customer')->get();

        $data = Sale::where('status', 'Lunas')->get()->groupBy(function($d) {
            return Carbon::parse($d->created_at)->format('F');
        });
        $data2 = Sale::get()->groupBy(function($d) {
            return Carbon::parse($d->created_at)->format('F');
        })->map(function ($row) {
            return $row->sum('total_bayar');
        });
        $chart_data = [];
        $chart_data2 = [];
        foreach ($data as $key => $value) {
            $chart_data[$key] = count($value);
        }
        foreach ($data2 as $key2 => $value2) {
            $chart_data2[$key2] = $value2;
        }
        $chart = new SaleReportController;
        $chart->labels = (array_keys($chart_data));
        $chart->datasets = (array_values($chart_data));
        $chart->labels2 = (array_keys($chart_data2));
        $chart->datasets2 = (array_values($chart_data2));

        $items = Item::withTrashed()->with(['sale' => function($query) use($request) {
            $query->where('status', 'Lunas');
        } ])->get();

        return view('toko.laporan.penjualan_index', compact('sales', 'users', 'chart', 'request', 'items'));
    }

    public function sale_print(Request $request)
    {
        if ($request->tanggal==NULL) {
            # code...
            $sales = Sale::with('user', 'items')->where('status', 'Lunas')->orderBy("created_at", "desc")->get();
        } else {
            # code...
            if ($request->user_id==NULL) {
                # code...
                switch ($request->jenis) {
                    case 'Harian':
                        # code...
                        $sales = Sale::with('user', 'items')->where('status', 'Lunas')->whereDate('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                    
                    case 'Bulanan':
                        # code...
                        $sales = Sale::with('user', 'items')->where('status', 'Lunas')->whereMonth('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                    
                    case 'Tahunan':
                        # code...
                        $sales = Sale::with('user', 'items')->where('status', 'Lunas')->whereYear('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
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
                        $sales = Sale::with('user', 'items')->where('status', 'Lunas')->where('user_id', $request->user_id)->whereDate('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                    
                    case 'Bulanan':
                        # code...
                        $sales = Sale::with('user', 'items')->where('status', 'Lunas')->where('user_id', $request->user_id)->whereMonth('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                    
                    case 'Tahunan':
                        # code...
                        $sales = Sale::with('user', 'items')->where('status', 'Lunas')->where('user_id', $request->user_id)->whereYear('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                        
                    default:
                        # code...
                        break;
                }
            }

        }
        $users = User::where('role', 'customer')->get();
        return view('toko.laporan.penjualan_print', compact('sales', 'users', 'request'));
    }
    
    public function sale_item_print(Request $request)
    {
        // dd(
        //     $items = Item::with(['sale' => function($query) use ($request) {
        //         $query->whereYear('created_at', 2021);
        //         $query->where('status', 'Lunas');
        //     }])->whereHas('sale', function($q) use ($request) {
        //         $q->whereYear('created_at', 2021);
        //     })->get()
        // );
        switch ($request->jenis2) {
            case 'Harian':
                # code...
                $items = Item::withTrashed()->with(['sale' => function($query) use ($request) {
                            $query->whereDate('created_at', $request->tanggal2);
                            $query->where('status', 'Lunas');
                        }])->whereHas('sale', function($q) use ($request) {
                            $q->whereDate('created_at', $request->tanggal2);
                            $q->where('status', 'Lunas');
                        })->get();
                break;
            
            case 'Bulanan':
                # code...
                $items = Item::withTrashed()->with(['sale' => function($query) use ($request) {
                            $query->whereMonth('created_at', $request->tanggal2);
                            $query->where('status', 'Lunas');
                        }])->whereHas('sale', function($q) use ($request) {
                            $q->whereMonth('created_at', $request->tanggal2);
                            $q->where('status', 'Lunas');
                        })->get();
                break;
            
            case 'Tahunan':
                # code...
                $items = Item::withTrashed()->with(['sale' => function($query) use ($request) {
                            $query->whereYear('created_at', $request->tanggal2);
                            $query->where('status', 'Lunas');
                        }])->whereHas('sale', function($q) use ($request) {
                            $q->whereYear('created_at', $request->tanggal2);
                            $q->where('status', 'Lunas');
                        })->get();
                break;
                
            default:
                # code...
                $items = Item::withTrashed()->with(['sale' => function($query) use($request) {
                    $query->where('status', 'Lunas');
                } ])->whereHas('sale', function($q) use ($request) {
                    $q->where('status', 'Lunas');
                })->get();
                break;
        }
        return view('toko.laporan.penjualan_barang_print', compact('items', 'request'));
    }
}
