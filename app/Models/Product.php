<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, HasTranslations, InteractsWithMedia;
    public $translatable = ['name', 'description', 'status'];
    protected $fillable = [
        'name',
        'price',
        'description',
        'status',
        'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
