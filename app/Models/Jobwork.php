<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Jobwork extends Model
{
    use HasFactory;

    protected $fillable = ['location'];

    public function translations()
    {
        return $this->hasMany(JobworkTranslation::class);
    }

    public function translation($locale = null)
    {
        $locale = $locale ?? App::getLocale();
        $result = $this->translations->where('locale', $locale)->first();
        if (!$result) {
            $result = $this->translations->first();
        }
        $result->location = $this->location;
        return $result;
    }
}
