<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = ['product_id','image_name'];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
