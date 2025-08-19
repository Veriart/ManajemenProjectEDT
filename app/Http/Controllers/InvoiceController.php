<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class InvoiceController extends Controller
{
    public function print(Invoice $record)
    {
        $company = Company::first();

        $pdf = Pdf::loadView('pdf.invoice', [
            'invoice' => $record,
            'company' => $company,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream("{$record->code}.pdf");
    }

}
