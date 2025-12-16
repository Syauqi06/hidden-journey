<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'facilities_list' => 'array', 
        'price_estimate' => 'integer',
    ];

    // Relasi satu destinasi bisa di-wishlist oleh banyak user
    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'wishlists', 'destination_id', 'user_id')
                    ->withTimestamps();
    }
}