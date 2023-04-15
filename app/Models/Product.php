<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Tag;
use App\Models\Stock;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'image',
        'description',
        'date',
        'location',
        'shop_address',
        'link',
        'file',
        'price'
    ];

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function stocks()
    {
        return $this->belongsToMany(Stock::class)->withPivot('quantity');
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
    }
}
