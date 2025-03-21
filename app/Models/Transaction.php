<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'value',
        'user_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
