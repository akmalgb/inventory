<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function Supplyings()
    {
        return $this->hasMany(Supplying::class);
    }

    public function ProductOrders()
    {
        return $this->hasMany(ProductOrder::class);
    }
}
