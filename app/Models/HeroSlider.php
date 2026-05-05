<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_badge', // e.g., "Enterprise Architecture"
        'heading',
        'description',
        'image_path',
        'button_text',
        'button_link',
        'display_order',
        'is_active',
    ];
}
