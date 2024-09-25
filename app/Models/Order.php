<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

      // Specify the table name if it's not the plural form of the model name
      protected $table = 'orders'; // Replace with your actual table name

      // Specify the primary key if it's not 'id'
      protected $primaryKey = 'order_id';
  
      // Define which fields are mass assignable (optional but recommended)
      protected $fillable = [
          'order_date',
          'status',
          'comments',
          'shipped_date',
          'shipper_id',
      ];
  
      // If the primary key is not auto-incrementing
      public $incrementing = false;

      // If your table doesn't use Laravel's default timestamps (created_at, updated_at)
      public $timestamps = false;

      public function customer(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

}
