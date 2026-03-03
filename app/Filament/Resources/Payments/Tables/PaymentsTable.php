<?php

namespace App\Filament\Resources\Payments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables;

class PaymentsTable
{
    public static function configure(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('invoice.member.full_name')
                ->label('Miembro')
                ->searchable(),

            Tables\Columns\TextColumn::make('invoice.id')
                ->label('Factura'),

            Tables\Columns\TextColumn::make('amount')
                ->money('ARS'),

            Tables\Columns\TextColumn::make('payment_method')
                ->label('Método'),

            Tables\Columns\TextColumn::make('payment_date')
                ->date(),

            Tables\Columns\TextColumn::make('created_at')
                ->since(),
        ])
        ->defaultSort('payment_date', 'desc');
}
}
