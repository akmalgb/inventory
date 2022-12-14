<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplying extends Model
{
    use HasFactory;

    public function Supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
}
