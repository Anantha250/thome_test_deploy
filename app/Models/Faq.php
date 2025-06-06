<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    public function translations()
    {
        return $this->hasMany(FaqTranslation::class);
    }

    public function faqTags()
    {
        return $this->belongsToMany(FaqTag::class, 'faq_with_tag');
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->translations()->where('locale', $locale)->first();
    }
}
