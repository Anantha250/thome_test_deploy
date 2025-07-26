<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ArticleHashTag extends Model
{
    use HasFactory;
    protected $casts = [
        'locale' => 'array',
    ];
    protected $fillable = ['locale'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? App::getLocale();
        $hashTags = $this->locale;
        $hashTagsNew = [];
        foreach ($hashTags as $hashTag) {
            $hashTagsNew[] = $hashTag[$locale] ?? $hashTag['en'] ?? $hashTag['th'] ?? '';
        }
        return $hashTagsNew;
    }
}
