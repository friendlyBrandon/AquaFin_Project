<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderlog extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'user_id', 'productname', 'quantity', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}