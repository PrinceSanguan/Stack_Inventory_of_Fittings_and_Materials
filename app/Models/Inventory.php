<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{

    protected $fillable = [
        'inventory_no',
        'category',
        'unit',
        'description',
        'beginning_balance',
        'issuance',
        'quantity',
        'unit_price',
        'inventory_value'
    ];

}
