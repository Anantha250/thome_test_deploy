<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ArticleTag extends Model
{
    use HasFactory;

    protected $fillable = [];

    function articles()
    {
        return $this->belongsToMany(Article::class, 'article_with_tag');
    }

    function translations()
    {
        return $this->hasMany(ArticleTagTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? App::getLocale();
        $result = $this->translations->where('locale', $locale)->first();
        if (!$result) {
            $result = $this->translations->first();
        }
        return $result;
    }
}
