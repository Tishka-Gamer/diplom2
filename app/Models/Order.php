<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function productInOrder()
    {
        return $this->belongsTo(ProductInOrder::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
