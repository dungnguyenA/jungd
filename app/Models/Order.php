<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'total',
        'user_id',
        'payment_status',
        'status',
        'voucher_id',
        'history_id',
    ];
    use HasFactory;
}
