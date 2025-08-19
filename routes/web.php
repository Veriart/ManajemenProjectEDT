<?php

use App\Http\Controllers\DeliveryOrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/app');
});

Route::get('/purchase-order/{record}/print', [\App\Http\Controllers\PurchaseOrderController::class, 'print'])
    ->name('purchase-order.print');

Route::get('/invoice/{record}/print', [\App\Http\Controllers\InvoiceController::class, 'print'])
    ->name('invoice.print');

Route::get('/invoice/{record}/download', [\App\Http\Controllers\InvoiceController::class, 'download'])
    ->name('invoice.download');

Route::get('/delivery-order/{deliveryOrder}/print', [DeliveryOrderController::class, 'print'])
    ->name('delivery-order.print');

Route::get('/sales-report/export-pdf', [\App\Http\Controllers\SalesReportController::class, 'exportPdf'])
    ->name('sales-report.export-pdf');

Route::get('/purchase-order/export-pdf', [\App\Http\Controllers\PurchaseOrderExportController::class, 'exportPdf'])
    ->name('purchase-order.export-pdf');

Route::get('/purchase-order/export-excel', [\App\Http\Controllers\PurchaseOrderExportController::class, 'exportExcel'])
    ->name('purchase-order.export-excel');

Route::get('/sales-report/export-excel', [\App\Http\Controllers\SalesReportController::class, 'exportExcel'])
    ->name('sales-report.export-excel');

Route::get('/project/{id}/export-bast', [\App\Http\Controllers\BastController::class, 'exportBast'])
    ->name('project.export-bast');
