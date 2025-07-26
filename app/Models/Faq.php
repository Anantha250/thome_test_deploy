<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

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
        $locale = $locale ?? App::getLocale();
        $result = $this->translations->where('locale', $locale)->first();
        if (!$result) {
            $result = $this->translations->first();
        }
        return $result;
    }
}
