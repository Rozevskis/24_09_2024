<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural form of the model name
    protected $table = 'customers'; // Replace with your actual table name

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'customer_id';

    // Define which fields are mass assignable (optional but recommended)
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'phone',
        'address',
        'city',
        'state',
        'points'
    ];

    // If the primary key is not auto-incrementing
    public $incrementing = false;

    // If the primary key is not an integer
    // protected $keyType = 'string'; // Only if it's a string, otherwise remove this line

    // If your table doesn't use Laravel's default timestamps (created_at, updated_at)
    public $timestamps = false;
}
