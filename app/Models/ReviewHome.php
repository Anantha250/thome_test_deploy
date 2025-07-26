<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class ReviewHome extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'project_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($house) {
            $house->folder_id = $house->id;
            $house->save();
        });

        static::deleting(function ($house) {
            Storage::deleteDirectory('public/review_home/' . $house->folder_id); // ลบไดเรกทอรีที่เก็บภาพของบทความ
        });
    }

    public function reviewHomeHashtags()
    {
        return $this->hasOne(ReviewHomeHashtag::class);
    }

    public function reviewHomeProject()
    {
        return $this->belongsTo(ReviewHomeProject::class, 'project_id');
    }

    public function translations()
    {
        return $this->hasMany(ReviewHomeTranslation::class);
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
