<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory, HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'mentor_user_id',
        'start_date_time',
        'end_date_time',
        'price_after_hours',
        'tax_cost',
        'career_insurance_cost',
        'add_on_tools_cost',
        'grand_total',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date_time' => 'datetime',
        'end_date_time' => 'datetime',
    ];

    /**
    * Get the attributes that should be cast.
    *
    * @return array<string, string>
    */
    protected function casts(): array
    {
        return [
            'status' => BookingStatus::class,
        ];
    }

    public function memberUser() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mentorUser() {
        return $this->belongsTo(User::class, 'mentor_user_id');
    }
}
