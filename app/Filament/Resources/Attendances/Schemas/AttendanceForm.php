<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('gym_id')
                    ->required()
                    ->numeric(),
                TextInput::make('member_id')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('check_in')
                    ->required(),
            ]);
    }
}
