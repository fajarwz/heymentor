<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum BookingStatus: int implements HasLabel, HasColor
{
    case STATUS_PENDING = 1;
    case STATUS_APPROVED = 2;
    case STATUS_REJECTED = 3;

    public function getLabel(): ?string
    {
        return match ($this) {
            self::STATUS_PENDING => 'Pending',
            self::STATUS_APPROVED => 'Approved',
            self::STATUS_REJECTED => 'Rejected',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::STATUS_PENDING => 'gray',
            self::STATUS_APPROVED => 'success',
            self::STATUS_REJECTED => 'danger',
        };
    }
}