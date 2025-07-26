<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ReviewHomeProject extends Model
{
    use HasFactory;
    protected $casts = [
        'locale' => 'array',
    ];
    protected $fillable = ['locale'];

    public function reviewHomes()
    {
        return $this->hasMany(ReviewHome::class, 'project_id');
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? App::getLocale();
        $result = $this->locale[$locale] ?? $this->locale['en'] ?? $this->locale['th'] ?? '';
        return $result;
    }

    public function hasTranslation($locale = null)
    {
        $locale = $locale ?? App::getLocale();
        return isset($this->locale[$locale]);
    }
}
