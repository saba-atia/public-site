<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'room_id', 'booking_date', 'booking_time', 'total_price',
    'status', 'breakfast', 'lunch', 'dinner', 'room_service',
    'parking', 'wifi', 'gym', 'pool'
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
