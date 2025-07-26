<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'subject_display',
        'message',
        'status',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'new' => 'bg-blue-100 text-blue-800',
            'read' => 'bg-yellow-100 text-yellow-800',
            'replied' => 'bg-green-100 text-green-800',
            'closed' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    public function scopeByStatus($query, $status)
    {
        if ($status !== 'all') {
            return $query->where('status', $status);
        }
        return $query;
    }

    public function scopeBySubject($query, $subject)
    {
        if ($subject !== 'all') {
            return $query->where('subject', $subject);
        }
        return $query;
    }
}
