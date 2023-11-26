<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'value'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_item()
    {
        return $this->belongsTo(Order_item::class);
    }

    public function order_items()
    {
        return $this->hasMany(Order_item::class);
    }

}

