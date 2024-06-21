<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function ingInProd()
    {
        return $this->hasMany(IngInProd::class);
    }
    public function productInOrder()
    {
        return $this->hasMany(ProductInOrder::class);
    }
    public function milks()
    {
        return $this->hasMany(Milk::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
