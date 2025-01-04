<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'price',
        'income',
        'duration',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'product_users')
            ->withPivot('income_total', 'last_collection', 'expires_at')
            ->withTimestamps();
    }
}
