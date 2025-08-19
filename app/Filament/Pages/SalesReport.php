<?php

namespace App\Filament\Pages;

use App\Models\PurchaseOrder;
use App\Models\Invoice;
use App\Models\DeliveryOrder;
use App\Models\DeliveryItem;
use Filament\Pages\Page;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Route;

class SalesReport extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Sales Report';
    protected static ?string $title = 'Sales Report';
    protected static ?string $navigationGroup = 'Report';
    protected static ?int $navigationSort = -1;

    protected static string $view = 'filament.pages.sales-report';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export_pdf')
                ->label('Export PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->url(function () {
                    $params = [
                        'start_date' => $this->data['start_date'] ?? now()->startOfMonth()->format('Y-m-d'),
                        'end_date' => $this->data['end_date'] ?? now()->endOfMonth()->format('Y-m-d'),
                        'status' => $this->data['status'] ?? 'all',
                        'type' => $this->data['type'] ?? 'all',
                    ];

                    return route('sales-report.export-pdf', $params);
                })
                ->openUrlInNewTab(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Filter Laporan')
                    ->schema([
                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->default(now()->startOfMonth())
                            ->reactive(),
                        DatePicker::make('end_date')
                            ->label('Tanggal Akhir')
                            ->default(now()->endOfMonth())
                            ->reactive(),
                        Select::make('status')
                            ->label('Status PO')
                            ->options([
                                'all' => 'Semua',
                                'Preparation' => 'Preparation',
                                'Process' => 'Process',
                                'BAST' => 'BAST',
                                'Success' => 'Success',
                                'Cancel' => 'Cancel',
                            ])
                            ->default('all')
                            ->reactive(),
                        Select::make('type')
                            ->label('Tipe PO')
                            ->options([
                                'all' => 'Semua',
                                'In' => 'In',
                                'Out' => 'Out',
                            ])
                            ->default('all')
                            ->reactive(),
                    ])
                    ->columns(4),
            ])
            ->statePath('data');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns([
                TextColumn::make('order_code')
                    ->label('Kode PO')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Tanggal PO')
                    ->date('d F Y')
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'In' => 'info',
                        'Out' => 'danger',
                    }),
                TextColumn::make('project.thirdParty.name')
                    ->label('Pelanggan/Vendor')
                    ->searchable(),
                TextColumn::make('project.name')
                    ->label('Nama Proyek')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Pending' => 'warning',
                        'Preparation' => 'gray',
                        'Process' => 'purple',
                        'BAST' => 'info',
                        'Success' => 'success',
                        'Cancel' => 'danger',
                    }),
                TextColumn::make('price')
                    ->label('Harga')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                TextColumn::make('inc_tax')
                    ->label('Termasuk Pajak')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                TextColumn::make('discount')
                    ->label('Diskon')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                TextColumn::make('invoices_count')
                    ->label('Jumlah Invoice')
                    ->counts('invoices')
                    ->sortable(),
                TextColumn::make('invoices_sum_amount_paid')
                    ->label('Total Dibayar')
                    ->sum('invoices', 'amount_paid')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                TextColumn::make('delivery_orders_count')
                    ->label('Jumlah DO')
                    ->counts('deliveryOrders')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([])
            ->bulkActions([])
            ->emptyStateHeading('Belum ada data penjualan')
            ->emptyStateDescription('Data penjualan akan muncul di sini setelah Anda membuat Purchase Order.');
    }

    protected function getTableQuery(): Builder
    {
        $query = PurchaseOrder::query()
            ->with(['thirdParty', 'invoices', 'deliveryOrders'])
            ->when(
                isset($this->data['start_date']) && $this->data['start_date'],
                fn(Builder $query) => $query->whereDate('created_at', '>=', $this->data['start_date'])
            )
            ->when(
                isset($this->data['end_date']) && $this->data['end_date'],
                fn(Builder $query) => $query->whereDate('created_at', '<=', $this->data['end_date'])
            )
            ->when(
                isset($this->data['status']) && $this->data['status'] !== 'all',
                fn(Builder $query) => $query->where('status', $this->data['status'])
            )
            ->when(
                isset($this->data['type']) && $this->data['type'] !== 'all',
                fn(Builder $query) => $query->where('type', $this->data['type'])
            );

        return $query;
    }

    public function filter(): void
    {
        // Metode ini akan dipanggil saat form disubmit
        // Tidak perlu melakukan apa-apa karena getTableQuery() sudah menggunakan data filter
    }
}
