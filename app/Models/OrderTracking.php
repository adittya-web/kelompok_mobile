<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTraking extends Model
{
    protected $table = 'order_trackings';
    protected $fillable = [
        'booking_id',
        'status',
        'note'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
