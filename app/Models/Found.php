<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Found extends Model
{
    use HasFactory;
    protected $table="funds";

    protected $fillable = [
        'liquid',
        'balance',
    ];
}
