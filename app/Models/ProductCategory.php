<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon_class',
        'is_active'
    ];

    public function subcategories()
    {
        return $this->hasMany(ProductSubcategory::class, 'category_id');
    }
}
