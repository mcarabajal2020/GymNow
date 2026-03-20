<?php

namespace App\Filament\Resources\Payments\Tables;

use App\Models\Invoice;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('invoice.member.full_name')
                    ->label('Miembro')
                    ->searchable(),

                TextColumn::make('invoice.id')
                    ->label('Factura'),

                TextColumn::make('amount')
                    ->label('Monto')
                    ->money('ARS'),

                TextColumn::make('payment_method')
                    ->label('Método'),

                TextColumn::make('payment_date')
                    ->label('Fecha de pago')
                    ->date(),
                    
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'success' => 'completed',
                        'danger' => 'void',
                    ]),
                TextColumn::make('voidedBy.name')
                    ->label('Anulado por')
                    ->placeholder('-'),

                TextColumn::make('voided_at')
                    ->label('Fecha anulación')
                    ->since()
                    ->placeholder('-'),    

                TextColumn::make('created_at')
                    ->since(),
            ])
            ->actions([

                EditAction::make()
                    ->visible(fn ($record) => $record->status === 'completed'),

                Action::make('void')
                    ->label('Anular')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'completed')
                    ->action(function ($record) {

                        // Marcar pago como anulado
                        $record->update([
                            'status' => 'void',
                            'voided_by' => auth()->id(),
                            'voided_at' => now(),
                        ]);

                        // Recalcular estado de la factura
                        $invoice = $record->invoice;

                        $totalPaid = $invoice->payments()
                            ->where('status', 'completed')
                            ->sum('amount');

                        if ($totalPaid >= $invoice->amount) {
                            $invoice->update(['status' => 'paid']);
                        } else {
                            $invoice->update(['status' => 'pending']);
                        }
                    }),
            ])
            ->defaultSort('payment_date', 'desc');
    }
}
