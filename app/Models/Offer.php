<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Offer extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;
    public $translatable = ['name'];
    protected $fillable = [
        'name',
        'type',
        'discount',
        'started_at',
        'ended_at',
        'poduct_id',
        'category_id',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_offer','offer_id','product_id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_offer','offer_id','category_id');
    }
}
