<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;


class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'cover_image',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function majorDepartment()
    {
        return $this->department()->majorDepartment();
    }

    public function translations()
    {
        return $this->hasMany(EmployeeTranslation::class);
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
