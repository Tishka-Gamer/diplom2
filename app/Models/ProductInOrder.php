<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInOrder extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function ingridients()
    {
        return $this->belongsTo(Ingridient::class);
    }
}
