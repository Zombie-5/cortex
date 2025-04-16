<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function hasUser()
    {
        return $this->users()
            ->where('product_users.user_id', Auth::id())
            ->wherePivot('expired', false)
            ->exists();
    }
}
