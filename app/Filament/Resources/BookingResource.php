<?php

namespace App\Filament\Resources;

use App\Enums\BookingStatus;
use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
                TextColumn::make('memberUser.name')->label('Member'),
                TextColumn::make('mentorUser.name')->label('Mentor'),
                TextColumn::make('start_date_time'),
                TextColumn::make('end_date_time'),
                TextColumn::make('status')->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->visible(fn (Booking $record) => $record->status !== BookingStatus::STATUS_APPROVED)
                    ->action(fn (Booking $record) => $record->update(['status' => BookingStatus::STATUS_APPROVED]))
                    ->extraAttributes(['style' => 'margin-right: auto'])
                    ->requiresConfirmation()
                    ->icon('heroicon-o-check')
                    ->color('success'),
                Tables\Actions\Action::make('reject')
                    ->visible(fn (Booking $record) => $record->status !== BookingStatus::STATUS_REJECTED)
                    ->action(fn (Booking $record) => $record->update(['status' => BookingStatus::STATUS_REJECTED]))
                    ->extraAttributes(['style' => 'margin-right: auto'])
                    ->requiresConfirmation()
                    ->icon('heroicon-o-x-mark')
                    ->color('danger'),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('approve-selected')
                    ->action(fn (Collection $records) => $records->each->update(['status' => BookingStatus::STATUS_APPROVED]))
                    ->requiresConfirmation()
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->size(ActionSize::Small)
                    ->outlined()
                    ->deselectRecordsAfterCompletion(),
                Tables\Actions\BulkAction::make('reject-selected')
                    ->action(fn (Collection $records) => $records->each->update(['status' => BookingStatus::STATUS_REJECTED]))
                    ->requiresConfirmation()
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->size(ActionSize::Small)
                    ->outlined()
                    ->deselectRecordsAfterCompletion(),
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
        ];
    }
}
