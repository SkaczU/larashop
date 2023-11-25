<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cerbero\QueryFilters\FiltersRecords;
 
class Service extends Model
{
    use HasFactory;
    use FiltersRecords;

    public $timestamps = false;
 
    protected $fillable = [
        'name',
        'description',
        'price',
        'available',
        
    ];

    public function order_item()
    {
        return $this->belongsTo(Order_item::class);
    }
}