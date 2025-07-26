<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'locale',
        'name',
        'position',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
