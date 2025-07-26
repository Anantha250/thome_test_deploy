<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ReviewHomeHashtag extends Model
{
    use HasFactory;

    protected $casts = [
        'locale' => 'array',
    ];
    protected $fillable = ['locale'];

    public function reviewHome()
    {
        return $this->belongsTo(Article::class);
    }

    public function translation($locale = null)
    {
        $hashtags = $this->locale;
        $hashtagsNew = [];
        foreach ($hashtags as $hashtag) {
            $hashtagsNew[] = $hashtag[$locale] ?? $hashtag['en'] ?? $hashtag['th'] ?? '';
        }
        return $hashtagsNew;
    }
}

