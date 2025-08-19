<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Purchase Order</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            padding: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .company-info {
            margin-bottom: 20px;
        }
        .filter-info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 10px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .summary {
            margin-top: 20px;
            text-align: right;
        }
        .summary-table {
            width: 300px;
            margin-left: auto;
        }
        .summary-table td {
            padding: 5px;
        }
        .summary-table .total {
            font-weight: bold;
        }
        .page-break {
            page-break-after: always;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('logo/edt.png') }}" alt="Logo" class="logo">
        <h2>DAFTAR PURCHASE ORDER</h2>
    </div>
    
    <div class="company-info">
        <h3>{{ $company->name }}</h3>
        <p>{{ $company->address }}</p>
        <p>Email: {{ $company->email }} | Telepon: {{ $company->phone }}</p>
    </div>
    
    <div class="filter-info">
        <p><strong>Periode:</strong> {{ $startDate->format('d F Y') }} - {{ $endDate->format('d F Y') }}</p>
        <p>
            <strong>Status:</strong> {{ $status === 'all' ? 'Semua' : $status }} | 
            <strong>Tipe:</strong> {{ $type === 'all' ? 'Semua' : $type }}
        </p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode PO</th>
                <th>Tanggal</th>
                <th>Tipe</th>
                <th>Pelanggan/Vendor</th>
                <th>Nama Proyek</th>
                <th>Status</th>
                <th>Harga</th>
                <th>Termasuk Pajak</th>
                <th>Jumlah Invoice</th>
                <th>Total Dibayar</th>
                <th>Jumlah DO</th>
            </tr>
        </thead>
        <tbody>
            @forelse($purchaseOrders as $index => $po)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $po->order_code }}</td>
                    <td>{{ Carbon\Carbon::parse($po->created_at)->format('d F Y') }}</td>
                    <td>{{ $po->type }}</td>
                    <td>{{ $po->thirdParty->name ?? '-' }}</td>
                    <td>{{ $po->project }}</td>
                    <td>{{ $po->status }}</td>
                    <td>Rp {{ number_format($po->price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($po->inc_tax, 0, ',', '.') }}</td>
                    <td>{{ $po->invoices->count() }}</td>
                    <td>Rp {{ number_format($po->invoices->sum('amount_paid'), 0, ',', '.') }}</td>
                    <td>{{ $po->deliveryOrders->count() }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" style="text-align: center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="summary">
        <table class="summary-table">
            <tr>
                <td>Total Harga:</td>
                <td>Rp {{ number_format($totalPrice, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Termasuk Pajak:</td>
                <td>Rp {{ number_format($totalIncTax, 0, ',', '.') }}</td>
            </tr>
            <tr class="total">
                <td>Total Dibayar:</td>
                <td>Rp {{ number_format($totalPaid, 0, ',', '.') }}</td>
            </tr>
            <tr class="total">
                <td>Sisa Pembayaran:</td>
                <td>Rp {{ number_format($totalIncTax - $totalPaid, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>
    
    <div style="margin-top: 50px; text-align: right;">
        <p>Dicetak pada: {{ now()->format('d F Y H:i:s') }}</p>
    </div>
</body>
</html>