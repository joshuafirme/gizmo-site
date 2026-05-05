<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'subcategory_id',
        'name',
        'slug',
        'description',
        'image_path',
        'icon_class',
        'is_featured',
        'is_active',
    ];

    public function subcategory()
    {
        return $this->hasOne(ProductSubcategory::class, 'id', 'subcategory_id');
    }
}
