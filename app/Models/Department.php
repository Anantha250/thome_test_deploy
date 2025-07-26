<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'd_order'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        // 'translations',
        // 'employees'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($department) {
            Storage::deleteDirectory('public/department/' . $department->id); // ลบไดเรกทอรีที่เก็บภาพของบทความ
        });
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function majorDepartment()
    {
        return $this->belongsTo(MajorDepartment::class);
    }

    public function translations()
    {
        return $this->hasMany(DepartmentTranslation::class);
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
