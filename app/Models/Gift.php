<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
