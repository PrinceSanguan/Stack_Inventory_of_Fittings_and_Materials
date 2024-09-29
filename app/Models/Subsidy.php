<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsidy extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'reorder',
        'inventory',
        'description',
        'unit',
        'balance',
        'issuance',
        'price',
        'stock',
        'value',
    ];
}
