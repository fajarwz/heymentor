<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'title_id',
        'start_date_experience',
        'about',
        'price_per_hour',
        'total_sessions',
    ];

    protected $casts = [
        'start_date_experience' => 'datetime',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function title() {
        return $this->belongsTo(Title::class);
    }
}
