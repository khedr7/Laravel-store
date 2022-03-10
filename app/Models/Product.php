<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
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
