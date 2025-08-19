<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EDT - Invoice</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            padding: 6.2rem 2rem 0 2rem;
            font-family: DejaVu Sans, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .company-info {
            margin-bottom: 2rem;
        }

        .invoice-details {
            margin-bottom: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total-section {
            float: right;
            width: 300px;
        }

        .total-row {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>INVOICE</h1>
    </div>

    <div class="company-info">
        <h2>{{ $company->name }}</h2>
        <p>{{ $company->address }}</p>
        <p>Phone: {{ $company->phone }}</p>
        <p>Email: {{ $company->email }}</p>
    </div>

    <div class="invoice-details">
        <table>
            <tr>
                <td><strong>Invoice Number:</strong></td>
                <td>{{ $invoice->code }}</td>
                <td><strong>Date:</strong></td>
                <td>{{ $invoice->created_at->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td><strong>Purchase Order:</strong></td>
                <td>{{ $invoice->purchaseOrder->order_code }}</td>
                <td><strong>Status:</strong></td>
                <td>{{ $invoice->status }}</td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $invoice->name }}</td>
                <td>Rp {{ number_format($invoice->amount_paid, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="total-section">
        <table>
            <tr class="total-row">
                <td><strong>Total Amount:</strong></td>
                <td>Rp {{ number_format($invoice->amount_paid, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>
</body>
</html>