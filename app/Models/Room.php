<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
      
                'room_id',
                'user_id',
                'booking_date',
                'booking_time',
                'breakfast',
                'lunch',
                'dinner',
                'room_service',
                'parking',
                'wifi',
                'gym',
                'pool',
                'total_price', // إضافة total_price
                'status',
            ];
        }
    