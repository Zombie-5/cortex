<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $casts = [
        'last_reset' => 'datetime',
    ];
    
    protected $fillable = [
        'user_id',
    ];

    public function resetIfNeeded() {
        if ($this->last_reset->isBefore(Carbon::today())) {
            $this->today = 0;
            $this->last_reset = now();
            $this->save();
        }
    }
    
}
