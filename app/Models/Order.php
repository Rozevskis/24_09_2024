<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; // Your actual table name
    protected $primaryKey = 'order_id';
    
    protected $fillable = [
        'order_date',
        'status', // This should match the order_status_id
        'comments',
        'shipped_date',
        'shipper_id',
    ];

    public $incrementing = false;
    public $timestamps = false;

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class); // Assuming this is the correct relationship
    }

    // Accessor for the status attribute to return the status name
    public function getStatusAttribute($value)
    {
        return DB::table('order_statuses')->where('order_status_id', $value)->value('name') ?? 'Unknown';
    }
}
