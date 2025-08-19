<?php

namespace App\Http\Controllers;

use App\Models\DeliveryOrder;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DeliveryOrderController extends Controller
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
    public function show(DeliveryOrder $deliveryOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeliveryOrder $deliveryOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeliveryOrder $deliveryOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryOrder $deliveryOrder)
    {
        //
    }

    /**
     * Generate PDF for delivery order.
     */
    public function print(DeliveryOrder $deliveryOrder)
    {
        // Eager load related models to prevent N+1 queries
        $deliveryOrder->load(['purchaseOrder.thirdParty', 'deliveryItems']);
        
        // Check if logo file exists
        $logoPath = 'logo-edt.png';
        if (!file_exists(public_path($logoPath))) {
            // Fallback to alternative logo paths
            if (file_exists(public_path('logo/edt.png'))) {
                $logoPath = 'logo/edt.png';
            } elseif (file_exists(public_path('logo/edt.jpg'))) {
                $logoPath = 'logo/edt.jpg';
            }
        }
        
        $pdf = Pdf::loadView('pdf.delivery-order', [
            'deliveryOrder' => $deliveryOrder,
            'logoPath' => $logoPath
        ]);
        
        return $pdf->stream('delivery-order.pdf');
    }
}
