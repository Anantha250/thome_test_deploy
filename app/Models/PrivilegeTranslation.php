<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivilegeTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['privilege_id', 'locale', 'title', 'coverPageImg', 'content'];
}
