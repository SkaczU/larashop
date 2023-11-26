<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'service_id',
        'quantity',
        'start_date',
        'end_date'
    ];


    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

}
