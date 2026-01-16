<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'html_code',
        'thumbnail',
        'is_premium'
    ];

    // Optional: Cast is_premium to boolean automatically
    protected $casts = [
        'is_premium' => 'boolean',
    ];
}