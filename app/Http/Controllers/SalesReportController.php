<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use App\Exports\SalesReportExport;
use Maatwebsite\Excel\Facades\Excel;

class SalesReportController extends Controller
{
    public function exportPdf(Request $request)
    {
        // Ambil parameter filter dari request
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : now()->endOfMonth();
        $status = $request->input('status', 'all');
        $type = $request->input('type', 'all');
        
        // Query data berdasarkan filter
        $query = PurchaseOrder::query()
            ->with(['thirdParty', 'invoices', 'deliveryOrders'])
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate);
            
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        if ($type !== 'all') {
            $query->where('type', $type);
        }
        
        $purchaseOrders = $query->get();
        
        // Hitung total
        $totalPrice = $purchaseOrders->sum('price');
        $totalIncTax = $purchaseOrders->sum('inc_tax');
        $totalPaid = $purchaseOrders->sum(function ($po) {
            return $po->invoices->sum('amount_paid');
        });
        
        // Ambil data perusahaan
        $company = Company::first();
        
        // Load view PDF
        $pdf = Pdf::loadView('pdf.sales-report', [
            'purchaseOrders' => $purchaseOrders,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'status' => $status,
            'type' => $type,
            'totalPrice' => $totalPrice,
            'totalIncTax' => $totalIncTax,
            'totalPaid' => $totalPaid,
            'company' => $company,
        ])->setPaper('A4', 'landscape');
        
        // Stream PDF ke browser
        return $pdf->stream('laporan-penjualan-' . $startDate->format('d-m-Y') . '-' . $endDate->format('d-m-Y') . '.pdf');
    }
    
    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status', 'all');
        $type = $request->input('type', 'all');
        
        return Excel::download(
            new SalesReportExport($startDate, $endDate, $status, $type),
            'laporan-penjualan-' . Carbon::parse($startDate)->format('d-m-Y') . '-' . Carbon::parse($endDate)->format('d-m-Y') . '.xlsx'
        );
    }
}