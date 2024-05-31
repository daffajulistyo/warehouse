<?php

namespace App\Http\Controllers\Reports;
use App\Http\Controllers\Controller;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use App\Models\StockMutation;

use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseReportController extends Controller
{
    public function purchase(Request $request)
    {
        // dd($request);
        if ($request->tanggal==NULL) {
            # code...
            if ($request->supplier_id==NULL) {
                # code...
                $purchases = Purchase::with('purchaseDetail.items')->orderBy("created_at", "desc")->get();
            } else {
                # code...
                $purchases = Purchase::with('purchaseDetail.items')->where('supplier_id', $request->supplier_id)->orderBy("created_at", "desc")->get();
            }
        } else {
            # code...
            if ($request->supplier_id==NULL) {
                # code...
                switch ($request->jenis) {
                    case 'Harian':
                        # code...
                        $purchases = Purchase::with('purchaseDetail.items')->whereDate('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                    
                    case 'Bulanan':
                        # code...
                        $purchases = Purchase::with('purchaseDetail.items')->whereMonth('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                    
                    case 'Tahunan':
                        # code...
                        $purchases = Purchase::with('purchaseDetail.items')->whereYear('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
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
                        $purchases = Purchase::with('purchaseDetail.items')->where('supplier_id', $request->supplier_id)->whereDate('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                    
                    case 'Bulanan':
                        # code...
                        $purchases = Purchase::with('purchaseDetail.items')->where('supplier_id', $request->supplier_id)->whereMonth('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                    
                    case 'Tahunan':
                        # code...
                        $purchases = Purchase::with('purchaseDetail.items')->where('supplier_id', $request->supplier_id)->whereYear('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                        
                    default:
                        # code...
                        break;
                }
            }

        }
        $suppliers = Supplier::all();

        $data = Purchase::get()->groupBy(function($d) {
            return Carbon::parse($d->created_at)->format('F');
        });
        $data2 = Purchase::get()->groupBy(function($d) {
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
        $chart = new PurchaseReportController;
        $chart->labels = (array_keys($chart_data));
        $chart->datasets = (array_values($chart_data));
        $chart->labels2 = (array_keys($chart_data2));
        $chart->datasets2 = (array_values($chart_data2));
        return view('toko.laporan.pembelian_index', compact('purchases', 'suppliers', 'chart'));
    }

    public function purchase_print(Request $request)
    {
        # code...
        // dd($usermcount);
        if ($request->tanggal==NULL) {
            # code...
            $purchases = Purchase::with('purchaseDetail.items')->orderBy("created_at", "desc")->get();
        } else {
            # code...
            if ($request->supplier_id==NULL) {
                # code...
                switch ($request->jenis) {
                    case 'Harian':
                        # code...
                        $purchases = Purchase::with('purchaseDetail.items')->whereDate('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                    
                    case 'Bulanan':
                        # code...
                        $purchases = Purchase::with('purchaseDetail.items')->whereMonth('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                    
                    case 'Tahunan':
                        # code...
                        $purchases = Purchase::with('purchaseDetail.items')->whereYear('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
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
                        $purchases = Purchase::with('purchaseDetail.items')->where('supplier_id', $request->supplier_id)->whereDate('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                    
                    case 'Bulanan':
                        # code...
                        $purchases = Purchase::with('purchaseDetail.items')->where('supplier_id', $request->supplier_id)->whereMonth('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                    
                    case 'Tahunan':
                        # code...
                        $purchases = Purchase::with('purchaseDetail.items')->where('supplier_id', $request->supplier_id)->whereYear('created_at', $request->tanggal)->orderBy("created_at", "desc")->get();
                        break;
                        
                    default:
                        # code...
                        break;
                }
            }

        }
        $suppliers = Supplier::all();
        return view('toko.laporan.pembelian_print', compact('purchases', 'suppliers', 'request'));
    }

}
