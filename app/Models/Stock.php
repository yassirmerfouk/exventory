<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Stock extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function GetSumQuantity()
    {
        $sum = 0;
        foreach ($this->products as $product) {
            $sum += $product->pivot->quantity;
        }
        return $sum;
    }
}
