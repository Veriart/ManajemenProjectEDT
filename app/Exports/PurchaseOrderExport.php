<?php

namespace App\Exports;

use App\Models\PurchaseOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Carbon;

class PurchaseOrderExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $startDate;
    protected $endDate;
    protected $status;
    protected $type;
    protected $thirdPartyId;

    public function __construct($startDate = null, $endDate = null, $status = 'all', $type = 'all', $thirdPartyId = 'all')
    {
        $this->startDate = $startDate ? Carbon::parse($startDate) : now()->startOfMonth();
        $this->endDate = $endDate ? Carbon::parse($endDate) : now()->endOfMonth();
        $this->status = $status;
        $this->type = $type;
        $this->thirdPartyId = $thirdPartyId;
    }

    public function collection()
    {
        $query = PurchaseOrder::query()
            ->with(['thirdParty', 'invoices', 'deliveryOrders'])
            ->whereDate('created_at', '>=', $this->startDate)
            ->whereDate('created_at', '<=', $this->endDate);
            
        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }
        
        if ($this->type !== 'all') {
            $query->where('type', $this->type);
        }
        
        if ($this->thirdPartyId !== 'all') {
            $query->where('third_party_id', $this->thirdPartyId);
        }
        
        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode PO',
            'Tanggal',
            'Tipe',
            'Pelanggan/Vendor',
            'Nama Proyek',
            'Status',
            'Harga',
            'Termasuk Pajak',
            'Jumlah Invoice',
            'Total Dibayar',
            'Jumlah DO',
        ];
    }

    public function map($purchaseOrder): array
    {
        static $rowNumber = 0;
        $rowNumber++;
        
        return [
            $rowNumber,
            $purchaseOrder->order_code,
            Carbon::parse($purchaseOrder->created_at)->format('d F Y'),
            $purchaseOrder->type,
            $purchaseOrder->thirdParty->name ?? '-',
            $purchaseOrder->project,
            $purchaseOrder->status,
            $purchaseOrder->price,
            $purchaseOrder->inc_tax,
            $purchaseOrder->invoices->count(),
            $purchaseOrder->invoices->sum('amount_paid'),
            $purchaseOrder->deliveryOrders->count(),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}