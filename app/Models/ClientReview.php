<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'position_company',
        'review_text',
        'rating',
        'image_path'
    ];
}
