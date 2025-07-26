<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageVariable extends Model
{
    use HasFactory;

    protected $casts = [
        'var' => 'array',
    ];

    protected $fillable = [
        'page',
        'var',
    ];
}
