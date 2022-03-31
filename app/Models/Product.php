<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;
    public $translatable = ['name', 'description', 'status'];
    protected $fillable = [
        'name',
        'price',
        'description',
        'status',
        'category_id',
        'current_price'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class ,'product_offer','product_id','offer_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
