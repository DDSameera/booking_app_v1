<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'room_id', 'check_in', 'check_out',
        'guests', 'total_price', 'status', 'reference',
        'full_name', 'email', 'phone'
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    public function room(): BelongsTo { return $this->belongsTo(Room::class); }
    public function user(): BelongsTo { return $this->belongsTo(User::class); }

}
