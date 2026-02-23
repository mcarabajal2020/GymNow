<?php

namespace App\Filament\Resources\Members\Schemas;

use App\Models\Plan as ModelsPlan;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Models\App\Models\Plan;

use function Laravel\Prompts\select;

class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('last_name')
                    ->required(),
                TextInput::make('dni')
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                DatePicker::make('birth_date'),
                TextInput::make('status')
                    ->required()
                    ->default('active'),
                Textarea::make('notes')
                    ->columnSpanFull(),
                select::make('plan_id')
                    ->label('Plan')
                    ->options(ModelsPlan::query()->pluck('name', 'id'))
                    ->searchable(),   
                        ]);
    }
}
