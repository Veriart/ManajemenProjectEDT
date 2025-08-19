<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Delivery Order {{ $deliveryOrder->code }}</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
            background: white;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 15mm;
            box-sizing: border-box;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            position: fixed;
            top: 20;
            left: 40;
            right: 50;
            /* padding: 10px 0; */
            border-bottom: 2px solid #000;
        }

        .logo {
            max-width: 120px;
            margin-bottom: 8px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .info {
            margin-top: 75px;
            margin-bottom: 25px;
        }

        .info-row {
            margin-bottom: 8px;
            display: flex;
            align-items: baseline;
        }

        .info-label {
            font-weight: bold;
            width: 140px;
            flex-shrink: 0;
        }

        table {
            width: 85%;
            border-collapse: collapse;
            margin-bottom: 25px;
            page-break-inside: avoid;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        td {
            height: 20px;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            page-break-inside: avoid;
        }

        .signature-box {
            width: 40%;
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid #000;
            margin-top: 60px;
            padding-top: 8px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="header">
            <img src="{{ public_path($logoPath) }}" alt="Logo" class="logo">
            <div class="title">DELIVERY ORDER</div>
        </div>

        <div class="info">
            <div class="info-row">
                <span class="info-label">DO Number:</span>
                <span>{{ $deliveryOrder->code }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Date:</span>
                <span>{{ $deliveryOrder->created_at->format('d-m-Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">PO Reference:</span>
                <span>{{ isset($deliveryOrder->purchaseOrder) ? ($deliveryOrder->purchaseOrder->order_code ?? 'N/A') : 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Project:</span>
                <span>{{ isset($deliveryOrder->purchaseOrder) ? ($deliveryOrder->purchaseOrder->project->name ?? 'N/A') : 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Third Party:</span>
                <span>{{ isset($deliveryOrder->purchaseOrder) && isset($deliveryOrder->purchaseOrder->project->thirdParty->name) ? ($deliveryOrder->purchaseOrder->project->thirdParty->name ?? 'N/A') : 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Project Location:</span>
                <span>{{ isset($deliveryOrder->purchaseOrder) ? ($deliveryOrder->purchaseOrder->project->project_location ?? 'N/A') : 'N/A' }}</span>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 8%">No</th>
                    <th style="width: 52%">Description</th>
                    <th style="width: 20%">Quantity</th>
                    <th style="width: 20%">UoM</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($deliveryOrder->deliveryItems as $index => $item)
                    <tr>
                        <td style="text-align: center">{{ $index + 1 }}</td>
                        <td>{{ $item->description ?? 'N/A' }}</td>
                        <td style="text-align: right">{{ $item->qty ?? '0' }}</td>
                        <td style="text-align: center">{{ $item->uom ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center">Tidak ada item</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="signatures">
            <div class="signature-box">
                <div class="signature-line">Received by</div>
            </div>
            <div class="signature-box">
                <div class="signature-line">Delivered by</div>
            </div>
        </div>
    </div>
</body>

</html>
