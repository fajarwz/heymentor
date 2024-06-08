<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory, HasUlids;

    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 3;
    
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

    public function member() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mentor() {
        return $this->belongsTo(User::class, 'mentor_user_id');
    }
}
