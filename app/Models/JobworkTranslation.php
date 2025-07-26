<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobworkTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'locale',
        'position',
        'location',
        'requirements',
    ];

    public function jobwork()
    {
        return $this->belongsTo(Jobwork::class);
    }
}
