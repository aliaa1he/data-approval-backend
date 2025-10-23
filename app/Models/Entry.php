<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'numeric_value',
        'date',
        'notes',
        'status',
        'calculated_field',
        'approved_by',
        'approved_at',
    ];

    public const CATEGORIES = [
        'Finance',
        'HR',
        'IT',
        'Operations',
        'Marketing',
    ];

    public static function allowedCategories()
    {
        return self::CATEGORIES;
    }

    /**
     * Get the user that owns the entry.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
