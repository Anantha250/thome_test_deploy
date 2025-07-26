<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewHomeTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['review_home_id', 'locale', 'title', 'coverPageImg', 'content'];

    public function reviewHome()
    {
        return $this->belongsTo(ReviewHome::class);
    }
}
