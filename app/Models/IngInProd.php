<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngInProd extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ingridient()
    {
        return $this->belongsTo(Ingridient::class);
    }
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
