<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = [
        'user_id',
        'service_id',
        'weight',
        'pickup_date',
        'address',
        'total_price',
        'status'
    ];
    
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    
}
