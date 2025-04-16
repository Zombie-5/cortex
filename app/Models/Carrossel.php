<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrossel extends Model
{
    use HasFactory;

    protected $table = 'carrossel';

    protected $fillable = [
        'name',
        'img',
        'status',
    ];
}
