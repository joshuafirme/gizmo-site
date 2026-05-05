<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhoWeAre extends Model
{
    use HasFactory;

    protected $table = 'who_we_are';

    protected $fillable = [
        'badge_text',
        'heading',
        'main_content',
        'bullet_points'
    ];

    protected $casts = [
        'bullet_points' => 'array'
    ];
}
