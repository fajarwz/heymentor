<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('member.name'),
                TextColumn::make('mentor.name'),
                TextColumn::make('start_date_time'),
                TextColumn::make('end_date_time'),
                TextColumn::make('status')
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->action(fn (Booking $record) => $record->update(['status' => Booking::STATUS_APPROVED]))
                    ->requiresConfirmation()
                    ->icon('heroicon-o-check')
                    ->color('success'),
                    // ->hidden(fn (Booking $record) => $record->status === Booking::STATUS_APPROVED),
                Tables\Actions\Action::make('reject')
                    ->action(fn ($record) => $record->update(['status' => Booking::STATUS_REJECTED]))
                    ->requiresConfirmation()
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    // ->visible($this->record->status !== Booking::STATUS_REJECTED),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
