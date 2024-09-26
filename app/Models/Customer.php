<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers'; 

    protected $primaryKey = 'customer_id';

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

    public $incrementing = false;

    protected $hidden = [
        'birth_date',
        'phone',
    ];

    public $timestamps = false;

    // Append the is_gold_member attribute to the JSON response
    protected $appends = ['is_gold_member'];

    // Accessor to check if a customer is a gold member
    public function getIsGoldMemberAttribute()
    {
        // Returns true if the customer has 2000 or more points
        return $this->points >= 2000;
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_id', 'customer_id'); // Specify the foreign key and local key
    }
}
