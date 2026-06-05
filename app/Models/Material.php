<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_number',
        'category',
        'stock',
    ];
    protected $table = 'materiallist';
}