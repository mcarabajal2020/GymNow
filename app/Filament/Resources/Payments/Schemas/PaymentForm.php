<?namespace App\Filament\Resources\Payments\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use App\Models\Member;
use App\Models\Invoice;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('member_selector')
                    ->label('Miembro')
                    ->options(
                        Member::where('status', 'active')
                            ->get()
                            ->mapWithKeys(fn ($m) => [
                                $m->id => $m->first_name . ' ' . $m->last_name
                            ])
                            ->toArray()
                    )
                    ->reactive()
                    ->dehydrated(false)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('invoice_id', null))
                    ->required()
                    ->searchable(),

                Select::make('invoice_id')
                    ->label('Factura pendiente')
                    ->options(function (callable $get) {

                        $memberId = $get('member_selector');

                        if (!$memberId) {
                            return [];
                        }

                        return Invoice::where('member_id', $memberId)
                            ->whereIn('status', ['pending', 'overdue'])
                            ->get()
                            ->mapWithKeys(function ($invoice) {
                                return [
                                    $invoice->id =>
                                        "Factura #{$invoice->id} | $ {$invoice->amount} | Vence: {$invoice->due_date->format('d/m/Y')}"
                                ];
                            })
                            ->toArray();
                    })
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {

                        $invoice = Invoice::find($state);

                        if ($invoice) {
                            $set('amount', $invoice->amount);
                        }
                    })
                    ->required(),

                TextInput::make('amount')
                    ->numeric()
                    ->required(),

                DatePicker::make('payment_date')
                    ->default(now())
                    ->required(),

                Select::make('payment_method')
                    ->options([
                        'cash' => 'Efectivo',
                        'mp' => 'Tarjeta',
                        'transfer' => 'Transferencia',
                    ])
                    ->required(),
            ]);
    }
}
