<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $table="manager_links";

    protected $fillable = [
        'link_manager',
        'link_customer_service',
        'link_group',
        'manager_id',
    ];
}
