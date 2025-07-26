<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastWorkTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'title',
    ];

    protected $casts = [
        'title' => 'array',
    ];

    public function pastworks()
    {
        return $this->hasMany(Pastwork::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        if (isset($this->title[$locale])) {
            $result = $this->title[$locale];
        } else if (isset($this->title['en'])) {
            $result = $this->title['en'];
            $locale = 'en';
        } else if (isset($this->title['th'])) {
            $result = $this->title['th'];
            $locale = 'th';
        }
        else {
            $result = '';
        }

        return [
            'title' => $result,
            'locale' => $locale,
        ];
    }
}
