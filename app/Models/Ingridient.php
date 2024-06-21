<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingridient extends Model
{
    use HasFactory;

    public function ingInProd()
    {
        return $this->hasMany(IngInProd::class);
    }
    public function productInOrder()
    {
        return $this->hasMany(ProductInOrder::class);
    }
    public function ingInBask()
    {
        return $this->hasMany(IngInProd::class);
    }
}
