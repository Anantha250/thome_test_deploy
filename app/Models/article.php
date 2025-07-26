<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;
    // protected $visible = ['id', 'slug', 'status', 'translation'];

    protected $fillable = [
        'id'
    ];

    protected $hidden = ['updated_at', 'translations', 'articleTags'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($article) {
            $article->folder_id = $article->id;
            $article->save();
        });

        static::deleting(function ($article) {
            Storage::deleteDirectory('public/article/' . $article->folder_id); // ลบไดเรกทอรีที่เก็บภาพของบทความ
        });
    }

    public function translations()
    {
        return $this->hasMany(ArticleTranslation::class);
    }

    function articleTags()
    {
        return $this->belongsToMany(ArticleTag::class, 'article_with_tag');
    }

    function articleHashTags()
    {
        return $this->hasOne(ArticleHashTag::class);
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
