<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngInBask extends Model
{
    use HasFactory;

    public function ingridient()
    {
        return $this->belongsTo(Ingridient::class);
    }
}
