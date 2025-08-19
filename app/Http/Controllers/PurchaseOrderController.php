<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ItemOrder;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }

    public function print(PurchaseOrder $record)
    {
        $taxAmount = ($record->total * $record->sales_tax) / 100;
        $grandTotal = $record->total + $taxAmount;
        $company = Company::first();
        $itemOrders = ItemOrder::where('purchase_order_id', $record->id)->get();

        $pdf = Pdf::loadView('pdf.purchase-order', [
            'po' => $record,
            'taxAmount' => $taxAmount,
            'grandTotal' => $grandTotal,
            'company' =>  $company,
            'itemOrders' => $itemOrders,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream("{$record->order_code}.pdf");
    }
}
